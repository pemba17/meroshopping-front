<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product; 

class SearchProduct extends Component
{
    public $name;
    public function mount($name){
        if($name){
            $this->name=$name;
        }else{
            abort(404);
        }
    }
    public function render()
    {
        $products=Product::when($this->name,function($q,$name){
            $q->where('name','LIKE','%'.$name.'%');
        })->get();
        return view('livewire.search-product',compact('products'));
    }
}
