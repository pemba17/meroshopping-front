<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Cookie;

class Nabil extends Model
{
    use HasFactory;

    public static function make_request($amount,$product_id){
		$user_id=(auth()->check())?(auth()->user()->id):'false';
        $request = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Request>
				<Operation>CreateOrder</Operation>
				<Language>EN</Language>
				<Order>
						<OrderType>Purchase</OrderType>
						<Merchant>'.'NABIL106508'.'</Merchant>
						<Amount>'.$amount.'</Amount>
						<Currency>524</Currency>
						<Description>Product Id : ' . $product_id . '</Description>
						<ApproveURL>' .'http://127.0.0.1:8000/nabil-approve' . '</ApproveURL>
						<CancelURL>' . 'http://127.0.0.1:8000/nabil-cancel/'.$user_id . '</CancelURL>
						<DeclineURL>' . 'http://127.0.0.1:8000/nabil-decline/' .$user_id. '</DeclineURL>
						<Fee>0</Fee>
				</Order>
				</Request>
			</TKKPG>';	
		$fpRequest = fopen(public_path().'/nabil/request.log', "w");
		fwrite($fpRequest, date('Y-m-d H:i:s') . "\n" . $request . "\n\n");
		fclose($fpRequest);
		return $request;
    }

	public static function sendRequest($request,$type) {
		if($type == "testing") {
			$twpg_cert_file= public_path().'/nabil/MEROSHOPPING.COM.crt';
			$twpg_key_file= public_path().'/nabil/meroshopping.key';
			$twpg_gateway_url = 'https://nabiltest.compassplus.com:8444/';
		} 
		else if($type == "live") {
			$twpg_cert_file = public_path().'/nabil/live/meroshopping.com.crt'; 
			$twpg_key_file = public_path().'/nabil/live/meroshopping.key';
			$twpg_gateway_url = 'https://nabilpg.compassplus.com:8443/';
		}
		$twpg_key_password = 'wlinkrupendra';
		$curl = curl_init();
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_POST => true,
			CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
			CURLOPT_URL => $twpg_gateway_url . '/Exec',
			CURLOPT_POSTFIELDS => $request,
			CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),
			CURLOPT_TIMEOUT => 30
		);

		if ($twpg_cert_file != '') {
			$options[CURLOPT_SSLCERT] = $twpg_cert_file;
			$options[CURLOPT_SSLKEY] = $twpg_key_file;
			$options[CURLOPT_SSLKEYPASSWD] = $twpg_key_password;
		}

		curl_setopt_array($curl, $options);
		$response = curl_exec($curl);
		if(!$response) {
			echo "Curl Error : " . curl_error($curl);
		}
		curl_close($curl);
		return $response;
	} 
}
