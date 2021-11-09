<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EsewaController extends Controller
{
    public function success(Request $request){

        $abc=explode(',',$request->oid);

        dd($abc);

        if(isset($request->oid) && isset($request->amt) && isset($request->refId)){
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data =[
                'amt'=> 'total_amount',
                'rid'=> $request->refId,
                'pid'=> $request->oid,
                'scd'=> 'EPAYTEST'
            ];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            $response_code=$this->get_xml_node_value('response_code',$response);

            if(trim($response_code)=='Success'){
                // success part
            }   
        }
    }

    public function fail(Request $request){

    }

    public function get_xml_node_value($node, $xml) {
	    if ($xml == false) {
	        return false;
	    }
	    $found = preg_match('#<'.$node.'(?:\s+[^>]+)?>(.*?)'.'</'.$node.'>#s', $xml, $matches);
	    if ($found != false) {
	        return $matches[1];  
	    }	  
        return false;
	}
}
