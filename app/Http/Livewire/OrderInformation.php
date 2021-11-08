<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Cookie;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderInformation extends Component
{
    public $order_id;
    public function mount($id=null){
        if($id)
        $this->order_id=$id;
        else
        $this->order_id=session()->get('order_id');
        
    }
    public function render()
    {
        $orders=Order::findOrFail($this->order_id);

        $order_products=OrderProduct::where('order_id',$this->order_id)
        ->rightJoin('products','order_products.product_id','products.id')
        ->get();
        
        return view('livewire.order-information',compact('orders','order_products'));
    }
}
