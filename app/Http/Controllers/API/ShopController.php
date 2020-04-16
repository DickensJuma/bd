<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductsCategory;
use App\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        return ProductsCategory::orderBy('name')->get(['id', 'name', 'image']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubCategories($id)
    {
        return SubCategory::orderBy('name')->where('product_category_id', $id)->with('products.files')->get(['id', 'name']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategoryProducts($id)
    {
        return Product::orderBy('title')->where('category_id', $id)->with('brand')->with('files')->get();
    }

    public function searchProducts(Request $request){

        if($search = $request->search) {

            $products = Product::orderBy('title')->where('category_id', $request->categoryId)->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%");
            })->with('brand')->with('files')->get();

            return $products;
        }else{
            return Product::orderBy('title')->where('category_id', $request->categoryId)->with('brand')->with('files')->get();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::where('uniqueId', $id)->with('files')->firstOrFail();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
