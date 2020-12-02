<?php

namespace App\Http\Controllers\API;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function subCategories(Request $request)
    {
        $category_id = $request->query('category');
        $sub = $request->query('sub');

        if ($category_id) {
            $sub_categories = SubCategory::orderBy('name')->where('product_category_id', $category_id)->get();
        } else {
            $sub_categories = SubCategory::orderBy('name')->get();
        }

        if ($category_id) {
            $brands = Brand::orderBy('name')->whereHas('subcategory', function ($query) use ($category_id) {
                return $query->where('product_category_id', $category_id);
            })->get();
        }
        if ($sub) {
            $brands = Brand::orderBy('name')->where('sub_category_id', $sub)->get();
        }


        $query = Product::query();
        if ($request->query('category')){
            $query->where('category_id', $request->query('category'));
        }

        if ($request->query('brand')){
            $query->where('brand_id', $request->query('brand'));
        }

        if ($request->query('sub')){
            $query->where('sub_category_id', $request->query('sub'));
        }

        $products = $query->orderBy('visitors', 'Desc')->whereHas('wholesaler.shop', function ($query) {
            $query->where('verification', 'verified');
        })->where('status', 1)->where('disabled', 'enabled')->with('brand')->with('files')->with('category')->get();

        return response()->json([
            'sub' => $sub_categories,
            'brands' => $brands,
            'products' => $products
        ], 200);
    }
}
