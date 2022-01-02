<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class TypeProduct extends Component
{
    use WithPagination;
    public $sort,$from_price,$to_price,$perPage=6,$search;
    public $type;
    public function mount($slug){
       $types=['latest-products','popular-items','weekly-popular-items','feature-items','hot-deals'];
       if(in_array($slug,$types)){
           $this->type=$slug;
       }else{
           abort(404);
       }
    }

    public function render()
    {
        $products=Product::when($this->search,function($q,$search){
        $q->where('name','LIKE','%'.$search.'%');
        })->when($this->sort,function($q,$sort){
            if($sort=='Low To High') $q->orderBy('price','asc');
            else $q->orderBy('price','desc');
        })->when($this->from_price,function($q){
            $q->when($this->to_price,function($k){
                $k->whereBetween('price',[$this->from_price,$this->to_price]);
            });
        })->when($this->type=='popular-items',function($q){
            $q->where('popular',1);

        })->when($this->type=='weekly-popular-items',function($q){
            $q->where('weekly_popular',1);

        })->when($this->type=='feature-items',function($q){
            $q->where('featured',1);

        })->when($this->type=='hot-deals',function($q){
            $q->where('hot_deal',1);
        })->orderBy('id','desc')->paginate($this->perPage);

        return view('livewire.type-product',compact('products'));
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
