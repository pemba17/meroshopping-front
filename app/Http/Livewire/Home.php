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

class Home extends Component
{
    public function render()
    {
        $hot_deal_products=Product::where('hot_deal',1)->take(8)->orderBy('id','desc')->get();
        $featured_products=Product::where('featured',1)->take(10)->orderBy('id','desc')->get();
        $circle_categories=Category::whereNull('parentId')->where('showInHighlighted',1)->take(6)->orderBy('id','desc')->get();
        $categories=Category::whereNull('parentId')->orderBy('position','asc')->get();
        $popular_products_from_popular=Product::where('popular',1)->get();
        $popular_products_from_week=Product::where('weekly_popular',1)->get();
        $popular_products=Product::where('popular',1)->orderBy('id','desc')->take(7)->get();
        $last_week_date=\Carbon\Carbon::today()->subDays(7);
        $weekly_popular_items=Product::where('weekly_popular',1)->orderBy('id','desc')->take(6)->get();
        $section_categories=Category::whereNull('parentId')->where('showInMain',1)->orderBy('id','desc')->take(3)->get();
        $trending_search=TrendingSearch::orderBy('count','desc')->take(10)->get();
        $popup_banner=DB::table('pop_up_banners')->where('status',1)->take(1)->get();

        $front_sliders=DB::table('main_sliders')->where('status',1)->orderBy('position','asc')->get();
        $last_banners=DB::table('banners')->where('status',1)->where('position','785*332')->orderBy('id','desc')->take(2)->get();
        $before_feature_banners=DB::table('banners')->where('status',1)->where('position','422*302')->orderBy('id','desc')->take(6)->get();
        $after_hot_banners=DB::table('banners')->where('status',1)->where('position','1328*200')->orderBy('id','desc')->first();
        $slider_right_banners=DB::table('banners')->where('status',1)->where('position','1000*1500')->orderBy('id','desc')->first();
        $after_popular_banners=DB::table('banners')->where('status',1)->where('position','320*320')->orderBy('id','desc')->first();

        $latest_product=Product::where('latest',1)->orderBy('created_at','desc')->take(10)->get();

        return view('livewire.home',compact('categories','hot_deal_products','circle_categories','featured_products','popular_products','weekly_popular_items','section_categories','trending_search','popup_banner','front_sliders',
        'last_banners','before_feature_banners','after_hot_banners','slider_right_banners','after_popular_banners','latest_product'
    ));
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
