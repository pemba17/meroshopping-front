<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category as Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\WishList;
use App\Models\Cart;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category,$combine_cat_id,$search_name;
    public $per_page=9,$sort;

    public function mount($slug=null,Request $request){
        $this->search_name=($request->search)?$request->search:null;
        $request->slug?$slug=$request->slug:$slug=$slug;
        if($slug){
            $cat=Categories::where('urltitle',$slug)->first();
            if($cat){
                $sub_category_id=Categories::where('parentId',$cat->id)->pluck('id');
                if($sub_category_id=="[]") $this->combine_cat_id=array($cat->id);
                else{
                    foreach($sub_category_id as $new){
                        $new_sub_cat_id[]=Categories::where('parentId',$new)->pluck('id')->first();
                    }
                    $this->combine_cat_id=array_merge(json_decode(json_encode($sub_category_id),true),$new_sub_cat_id,array($cat->id));
                }
                $this->category=$cat;
            }else abort(404);
        }else{
            if($request->search) return redirect()->to('search/'.$request->search); else abort(404); 
        }  
    }

    public function render(){
        $products=Product::whereIn('categoryId',$this->combine_cat_id)
                ->when($this->search_name,function($q,$search){
                    $q->where('name','LIKE','%'.$search.'%');
                })->when($this->sort,function($q,$sort){
                    if($sort=='Low To High') $q->orderBy('price','asc');
                    else $q->orderBy('price','desc');
                })->orderBy('id','desc')->paginate($this->per_page);
                                
        return view('livewire.category',compact('products'));
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
