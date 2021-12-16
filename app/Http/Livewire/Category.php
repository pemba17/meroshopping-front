<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category as Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\BestSeller;
use App\Models\TrendingSearch;
use App\Models\Brand;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category,$combine_cat_id,$search_name;
    public $per_page=9,$sort;

    public $from_price,$to_price,$brand_id=[];

    public function search(){}

    public function mount($slug=null,Request $request){
        if($request->search) TrendingSearch::addSearch($request->search);
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
                ->when((array_filter($this->brand_id)),function($q,$brand_id){
                    $q->whereIn('brandId',array_filter($brand_id));
                })
                ->when($this->search_name,function($q,$search){
                    $q->where('name','LIKE','%'.$search.'%');
                })->when($this->sort,function($q,$sort){
                    if($sort=='Low To High') $q->orderBy('price','asc');
                    else $q->orderBy('price','desc');
                })->when($this->from_price,function($q){
                    $q->when($this->to_price,function($k){
                        $k->whereBetween('price',[$this->from_price,$this->to_price]);
                    });
                })->orderBy('id','desc')->paginate($this->per_page);

        $brand_id=Product::whereIn('categoryId',$this->combine_cat_id)->where('brandId','!=',0)->groupBy('brandId')->pluck('brandId');

        $color_id=Product::whereIn('categoryId',$this->combine_cat_id)->whereNotNull('colorIds')->where('colorIds','!=',"")->pluck('colorIds')->toArray();

        // $ids=[];
        
        // if(count($color_id)>0){
        //     foreach($color_id as $row){
        //         $data[]=explode(',',$row);
        //     }
    
        //     foreach($data as $next){
        //         foreach($next as $next1){
        //             if($next1!=" "){
        //                 $ids[]=trim($next1);
        //             }
        //         }
        //     }

        //     if(count($ids)>0){
        //         $new_color_id=
        //     }
        // }
        
        $brands=Brand::whereIn('id',$brand_id)->get();

        $best_sellers=BestSeller::leftJoin('retailers','best_sellers.retailer_id','retailers.id')
                        ->leftJoin('users','retailers.id','users.retailer_id')
                        ->orderBy('position','asc')->take(5)->get();
                                
        return view('livewire.category',compact('products','best_sellers','brands'));
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
        $this->search_name=null;
    }
}
