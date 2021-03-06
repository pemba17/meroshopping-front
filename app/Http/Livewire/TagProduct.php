<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tag;
use Livewire\WithPagination;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Brand;

class TagProduct extends Component
{
    use WithPagination;
    public $tag_url,$perPage=6,$tag,$sort,$search,$from_price,$to_price,$brand_id=[];

    public function searchData(){}
    public function mount($slug){
        $this->tag=Tag::where('urlname',$slug)
                  ->first();
        if($this->tag) $this->tag_url=$slug; else abort(404);            
    }
    public function render()
    {
        $products=Tag::select('products.id','products.name','products.urlname','products.filename','products.price','tags.urlname as tag_urlname','tags.name as tag_name')
                    ->when((array_filter($this->brand_id)),function($q,$brand_id){
                        $q->whereIn('brandId',array_filter($brand_id));
                    })
                ->rightJoin('product_tags','tags.id','product_tags.tagId')
                ->rightJoin('products','product_tags.productId','products.id')
                ->where('tags.urlname',$this->tag_url)
                ->when($this->sort,function($q,$sort){
                    if($sort=='Low To High') $q->orderBy('price','asc');
                    else $q->orderBy('price','desc');
                })->when($this->search,function($q,$search){
                    $q->where('products.name','LIKE','%'.$search.'%');

                })->when($this->from_price,function($q){
                    $q->when($this->to_price,function($k){
                        $k->whereBetween('price',[$this->from_price,$this->to_price]);
                    });
                })->paginate($this->perPage);
         
        $product_ids=Tag::select('productId')
                    ->rightJoin('product_tags','tags.id','product_tags.tagId')
                    ->rightJoin('products','product_tags.productId','products.id')
                    ->where('tags.urlname',$this->tag_url)
                    ->get();

        $brand_id=Product::whereIn('id',$product_ids)->where('brandId','!=',0)->groupBy('brandId')->pluck('brandId');

        $brands=Brand::whereIn('id',$brand_id)->get();
    
        return view('livewire.tag-product',compact('products','brands'));
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

    public function resetData(){
        $this->from_price=null;
        $this->to_price=null;
        $this->search=null; 
    }
}
