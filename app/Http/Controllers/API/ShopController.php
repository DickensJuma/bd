<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\ProductCategory;
use App\SubCategory;
use Illuminate\Http\Request;

/**
 * @group  Shop
 *
 * APIs for Managing Shops
 */
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        return ProductCategory::orderBy('name')->get(['id', 'name', 'image']);
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
        return Product::orderBy('visitors', 'Desc')->whereHas('wholesaler.shop', function ($query){
            $query->where('verification', 'verified');
        })->where('disabled', 'enabled')->where('category_id', $id)->with('brand')->with('files')->get();
    }

    public function searchCategories(Request $request){
        $this->validate($request, [
            'search' => 'required|string',
        ]);

        if($search = $request->search) {
            return ProductCategory::orderBy('name')->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->get();

        }else{
            return ProductCategory::orderBy('name')->get();
        }
    }

    public function searchProducts(Request $request){

        if($search = $request->search) {

            $products = Product::orderBy('visitors', 'Desc')->where('category_id', $request->categoryId)->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%");
            })->with('brand')->with('files')->get();

            return $products;
        }else{
            return Product::orderBy('visitors', 'Desc')->where('category_id', $request->categoryId)->with('brand')->with('files')->get();
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
        return Product::where('uniqueId', $id)->with('files')->with(array('brand' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('subcategory' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('category' => function ($query) {
            $query->select('id', 'name');
        }))->firstOrFail();
    }

    public function shopDetail($id){
        return User::where('id',$id)->with('shop')->get();
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
