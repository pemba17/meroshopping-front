<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category as Categories;
use App\Models\Product;

class Category extends Component
{
    public $slug,$products,$category;
    public function mount($slug){
        $category=Categories::where('urltitle',$slug)
                  ->first()
                  ->toArray();
        if($category){
            // check if sub category exist
            $sub_category_id=Categories::where('parentId',$category['id'])->get()->pluck('id');
            if($sub_category_id=="[]"){
                $sub_category_id=array($category['id']);
            }
             $this->products=Product::whereIn('categoryId',$sub_category_id)->get();    
            $this->category=$category;  
        }else{
            abort(404);
        }                    
    }
    public function render()
    {
        return view('livewire.category');
    }
}
