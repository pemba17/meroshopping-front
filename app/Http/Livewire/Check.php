<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Check extends Component
{
    public function render()
    {
        $hot_deal_products=Product::where('hot_deal',1)->take(8)->get();
        $featured_products=Product::where('featured',1)->take(10)->get();
        $circle_categories=Category::whereNull('parentId')->take(6)->get();
        $categories=Category::whereNull('parentId')->orderBy('position','asc')->get();
        $popular_products=Product::where('popular',1)->take(6)->get();

        return view('livewire.check',compact('categories','hot_deal_products','circle_categories','featured_products','popular_products'));
    }
}
