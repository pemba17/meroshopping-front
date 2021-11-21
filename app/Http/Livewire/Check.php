<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\WishList;
use App\Models\Order;
use DB;

class Check extends Component
{
    public $ids,$show_categories_main,$sub_cat_products,$abc=false;

    public function mount(){
        $this->show_categories_main=Category::whereNull('parentId')->where('showInMain',1)->take(3)->get();

        $cat_id=array_column(json_decode(json_encode($this->show_categories_main),true),'id');

        // foreach($cat_id as $row){
        //     $this->ids[]=Category::where('parentId',$row)->orderBy('id','desc')->pluck('id')->first();
        // }

        $this->ids=[327,333,339];
    }
    public function render()
    {
        $hot_deal_products=Product::where('hot_deal',1)->take(8)->orderBy('id','desc')->get();
        $featured_products=Product::where('featured',1)->take(10)->orderBy('id','desc')->get();
        $circle_categories=Category::whereNull('parentId')->take(6)->orderBy('id','desc')->get();
        $categories=Category::whereNull('parentId')->orderBy('position','asc')->get();
        $popular_products=Order::select('product_id','products.name','urlname','filename','price',DB::raw('COUNT(product_id) as count'))->leftJoin('order_products','orders.id','order_products.order_id')
        ->leftJoin('products','order_products.product_id','products.id')
        ->where('order_status','delivered')
        ->groupBy('product_id')
        ->orderBy('count','DESC')
        ->take(6)
        ->get();

        $last_week_date=\Carbon\Carbon::today()->subDays(7);
        $weekly_popular_items=Order::select('product_id','products.name','urlname','filename','price',DB::raw('COUNT(product_id) as count'))->leftJoin('order_products','orders.id','order_products.order_id')
        ->leftJoin('products','order_products.product_id','products.id')
        ->where('order_status','delivered')
        ->where('orders.created_at','>=',$last_week_date)
        ->groupBy('product_id')
        ->orderBy('count','DESC')
        ->take(3)
        ->get();

        foreach($this->ids as $id){
            $this->sub_cat_products[]=Product::where('categoryId',$id)->take(8)->get();
        }

        return view('livewire.check',compact('categories','hot_deal_products','circle_categories','featured_products','popular_products','weekly_popular_items'));
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

    public function changeCat($key,$id){
        $this->ids[$key]=341;
        $this->sub_cat_products=[];
    }
}
