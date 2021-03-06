<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\Cart;
use App\Models\WishList;
use App\Models\TrendingSearch;

class SearchProduct extends Component
{
    use WithPagination;
    public $name,$perPage=6,$sort;
    public function mount($name){
        TrendingSearch::addSearch($name);
        if($name){
            $this->name=$name;
        }else{
            abort(404);
        }
    }
    public function render()
    {
        if(substr($this->name, 0, 5)=="sanfo"  || substr($this->name, 0, 5)=="phili" ||substr($this->name, 0, 5)=="yasud"){
            $products=Product::when($this->name,function($q,$name){
                $q->where('name','LIKE','')->where('status',1 );
            })->when($this->sort,function($q,$sort){
                if($sort=='Low To High') $q->orderBy('price','asc');
                else $q->orderBy('price','desc');
            })->paginate($this->perPage);
        }else{
            $products=Product::when($this->name,function($q,$name){
                $q->where('name','LIKE',$name.'%')->where('status',1 );
            })->when($this->sort,function($q,$sort){
                if($sort=='Low To High') $q->orderBy('price','asc');
                else $q->orderBy('price','desc');
            })->paginate($this->perPage);
        }

        return view('livewire.search-product',compact('products'));
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
