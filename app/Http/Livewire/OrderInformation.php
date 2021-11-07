<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Cookie;

class OrderInformation extends Component
{
    public $client_id;
    public function mount(){
    
    }
    public function render()
    {
        $orders=Order::where('client_id',$this->client_id)
                        ->get();
        return view('livewire.order-information',compact('orders'));
    }
}
