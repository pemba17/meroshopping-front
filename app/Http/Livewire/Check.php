<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Check extends Component
{
    public function render()
    {
        $products=Product::get();
        $categories=Category::whereNull('parentId')->orderBy('position','asc')->get();
        return view('livewire.check',compact('categories','products'));
    }
}
