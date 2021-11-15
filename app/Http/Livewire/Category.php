<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category as Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class Category extends Component
{
    public $slug,$products,$category;
    public function mount($slug=null,Request $request){
        // main category
        ($request->slug)?$slug=$request->slug:$slug=$slug;
        if($slug){
            $category=Categories::where('urltitle',$slug)
                    ->first()
                    ->toArray();

            if($category){
                // check if sub category exist
                $sub_category_id=Categories::where('parentId',$category['id'])->pluck('id');
                // check uf sub_category has child or not
                if($sub_category_id=="[]") $combine_cat_id=array($category['id']);
                
                else{
                    foreach($sub_category_id as $new){
                        $new_sub_cat_id[]=Categories::where('parentId',$new)->pluck('id')->first();
                    }

                    $combine_cat_id=array_merge(json_decode(json_encode($sub_category_id),true),$new_sub_cat_id,array($category['id']));
                }
                $this->products=Product::whereIn('categoryId',$combine_cat_id)
                                ->when($request->search,function($q,$search){
                                    $q->where('name','LIKE','%'.$search.'%');
                                })->get();    
                $this->category=$category;
            }else{
                abort(404);
            }
        }
        else{
            if($request->search) return redirect()->to('search/'.$request->search); else abort(404); 
        }                  
    }
    public function render()
    {
        return view('livewire.category');
    }
}
