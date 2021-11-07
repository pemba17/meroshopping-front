<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $data=session()->get('info');
        return view('payment',compact('data'));
    }
}
