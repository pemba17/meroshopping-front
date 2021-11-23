<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\WishList;
use App\Models\Brand;
use App\Models\Product;
use Livewire\WithPagination;

class BrandProduct extends Component
{
    use WithPagination;
    public $brand,$sort,$from_price,$to_price,$perPage=6,$search;
    public function mount($slug){
        $brand=Brand::where('urlname',$slug)->first();
        if($brand){
            $this->brand=$brand;
        }else abort(404);
    }

    public function render()
    {
        $products=Product::has('brand')->with('brand')
        ->when($this->search,function($q,$search){
            $q->where('name','LIKE','%'.$search.'%');
        })->when($this->sort,function($q,$sort){
            if($sort=='Low To High') $q->orderBy('price','asc');
            else $q->orderBy('price','desc');
        })->when($this->from_price,function($q){
            $q->when($this->to_price,function($k){
                $k->whereBetween('price',[$this->from_price,$this->to_price]);
            });
        })->orderBy('id','desc')->paginate($this->perPage);

        return view('livewire.brand-product',compact('products'));
    }

    public function resetData(){
        $this->from_price=null;
        $this->to_price=null;
        $this->search=null;
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
