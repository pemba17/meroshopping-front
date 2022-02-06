<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function getCategories()
    {
        $categories=Category::select('id','parentId','title','urltitle','image','position','icon','showInMain')->whereNull('parentId')->orderBy('position','asc')->get();
        if($categories){
            return response()->json(['data'=>$categories]);
        }else{
            return response()->json(['message'=>'No Categories Found']);
        }
    }

    // get highlighted Categories
    public function getFetCategories()
    {
        $categories=Category::select('id','parentId','title','urltitle','image','position','showInMain')->where('showInHighlighted',1)->take(6)->whereNull('parentId')->orderBy('position','asc')->get();
        if(count($categories)>0){
            return response()->json(['data'=>$categories]);
        }else{
            return response()->json(['message'=>'No Categories Found']);
        }
    }

    // get products according to categries with category id
    public function getCategoryProducts(Request $request)
    {
        $ParentCategory=Category::where('id',$request->categoryId)->pluck('id')->first();
        if($ParentCategory){
            $SubCategoriesId=Category::select('id')->where('parentId',$ParentCategory)->get();
            if($SubCategoriesId){
                $subsubCategoriesId=Category::select('id')->whereIn('parentId',$SubCategoriesId)->get();
                if($subsubCategoriesId){
                    $products=Product::WhereIn('categoryId',$subsubCategoriesId)->get();
                    return $products;
                }else{
                    $products=Product::where('categoryId',$ParentCategory)->orWhereIn('categoryId',$SubCategoriesId)->get();
                }
            }else{
                $products=Product::where('categoryId',$ParentCategory)->get();
            }
            if($products){
                return response()->json(['data'=>$products]);
            }
        }else{
            return response()->json(['message'=>'No Products Found']);
        }

    }
    // get subcategories along with categories
    public function getSubCategories(Request $request)
    {
        $subcategories=Category::select('id','parentId','title','urltitle','image','position','showInMain')->where('parentId',$request->categoryId)->get();
        if(count($subcategories)>0){
            return response()->json(['data'=>$subcategories]);
        }else{
            return response()->json(['message'=>'No Categories Found']);
        }
    }

     // get product according to subcategories
     public function getSubCategory(Request $request)
     {
         $subcategories=Category::where('parentId',$request->categoryId)->get();
         if(count($subcategories)>0){
             return response()->json(['data'=>$subcategories]);
         }else{
             return response()->json(['message'=>'No subcategories Found']);
         }
     }
    public function getSubCategoryProducts(Request $request)
     {
            $SubCategoriesId=Category::select('id')->where('parentId',$request->subcategoryId)->get();
            if($SubCategoriesId)
            {
                $subsubCategoriesId=Category::select('id')->whereIn('parentId',$SubCategoriesId)->get();
                if($subsubCategoriesId){
                    $products=Product::WhereIn('categoryId',$subsubCategoriesId)->orWhereIn('categoryId',$SubCategoriesId)->get();
                }else{
                    $products=Product::WhereIn('categoryId',$SubCategoriesId)->get();
                }
                if($products){
                    return response()->json(['data'=>$products]);
                }
            }else{
                return response()->json(['message'=>'No Products Found']);
            }
     }
     public function getSubSubCategoryProducts(Request $request)
     {
         $subcategoryproducts = Product::where('categoryId',$request->subcategoryId)->get();
         if(count($subcategoryproducts)>0){
             return response()->json(['data'=>$subcategoryproducts]);
         }else{
             return response()->json(['message'=>'No products Found']);
         }
     }
    //  public function getSingleSubCategoryProducts(Request $request)
    //  {
    //      $subcategories=Category::select('id','parentId','title','urltitle','image','position','showInMain')->where('parentId',$request->categoryParentId)->get();
    //      $subcategoryproducts = Product::where('categoryId',$request->subCategoryParentId)->get();

    //      if(count($subcategories)>0){
    //          return response()->json(['data'=>$subcategoryproducts]);
    //      }else{
    //          return response()->json(['message'=>'No Categories Found']);
    //      }
    //  }
    // get products according to brands with brandId
    public function getBrandProducts(Request $request)
    {

        $products_brand = Product::where('brandId',$request->id)->get();
        if($products_brand){
            return response()->json(['data'=>$products_brand]);
        }else{
            return response()->json(['error'=>'No Brands Found']);
        }
    }

    // get products according to tags with tagId
    public function getTagsProduct(Request $request)
    {
        $tag=Tag::find($request->id);
        $product_tags=ProductTag::where('tagId',$tag->id)->pluck('productId')->toArray();
        $tagproducts=Product::whereIn('id',$product_tags)->get();
        if($tagproducts){
            return response()->json(['data'=>$tagproducts]);
        }else{
            return response()->json(['error'=>'No Tags Found']);
        }

    }

    //
}
