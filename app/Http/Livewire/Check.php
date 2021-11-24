<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\WishList;
use App\Models\Order;
use App\Models\TrendingSearch;
use DB;

class Check extends Component
{
    public function render()
    {
        $hot_deal_products=Product::where('hot_deal',1)->take(8)->orderBy('id','desc')->get();
        $featured_products=Product::where('featured',1)->take(10)->orderBy('id','desc')->get();
        $circle_categories=Category::whereNull('parentId')->where('showInHighlighted',1)->take(6)->orderBy('id','desc')->get();
        $categories=Category::whereNull('parentId')->orderBy('position','asc')->get();
        // $popular_products_from_popular=Product::where('popular',1)->get();
        // $popular_products_from_week=Product::where('weekly_popular',1)->get();
        // if(count($popular_products_from_popular)>0) $popular_products=Product::where('popular',1)->orderBy('id','desc')->take(7)->get();
        // else{
        //     $popular_products=Order::select('product_id','products.name','urlname','filename','price',DB::raw('COUNT(product_id) as count'))->leftJoin('order_products','orders.id','order_products.order_id')
        //     ->leftJoin('products','order_products.product_id','products.id')
        //     ->where('order_status','delivered')
        //     ->groupBy('product_id')
        //     ->orderBy('count','DESC')
        //     ->take(7)
        //     ->get();
        // }
        // $last_week_date=\Carbon\Carbon::today()->subDays(7);
        // if(count($popular_products_from_week)>0) $weekly_popular_items=Product::where('weekly_popular',1)->orderBy('id','desc')->take(7)->get();
        // else{
        //     $weekly_popular_items=Order::select('product_id','products.name','urlname','filename','price',DB::raw('COUNT(product_id) as count'))->leftJoin('order_products','orders.id','order_products.order_id')
        //     ->leftJoin('products','order_products.product_id','products.id')
        //     ->where('order_status','delivered')
        //     ->where('orders.created_at','>=',$last_week_date)
        //     ->groupBy('product_id')
        //     ->orderBy('count','DESC')
        //     ->take(7)
        //     ->get();
        // }

        $popular_products=[];
        $weekly_popular_items=[];
        $section_categories=Category::whereNull('parentId')->where('showInMain',1)->orderBy('id','desc')->take(3)->get();
        $trending_search=TrendingSearch::orderBy('count','desc')->take(10)->get();
        

        return view('livewire.check',compact('categories','hot_deal_products','circle_categories','featured_products','popular_products','weekly_popular_items','section_categories','trending_search'));
    }

    public function addToCart($product_id,$quantity=1){
        $output=Cart::addCart($product_id,$quantity);
        if($output) {session()->flash('color','success');return redirect()->to('cart')->with('success','Product Added To Cart Successfully');}
    }

    public function addToWishList($product_id){
        $output=WishList::addWishList($product_id);
        if($output==true) return redirect()->to('wishlist')->with('success','Product Added To Wishlist Successfully');
        else return redirect()->to('login');
    }
}
