<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderHistory extends Component
{
    public function render()
    {
        $history=Order::with('product','orderProduct')->where('client_id',auth()->user()->id)->get();
        return view('livewire.order-history',compact('history'));
    }
}
