<?php

namespace App\Http\Controllers\API;

use App\Brand;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function subCategories(Request $request)
    {
        $category_id = $request->input('category');
        $sub = $request->input('sub');

        if ($category_id) {
            $sub_categories = SubCategory::orderBy('name')->where('product_category_id', $category_id)->get();
        } else {
            $sub_categories = SubCategory::orderBy('name')->get();
        }

        if ($category_id && !$sub) {
            $brands = Brand::orderBy('name')->with(['subcategory', function ($query) use ($category_id) {
                return $query->where('product_category_id', $category_id);
            }])->get();
        }
        if ($sub) {
            $brands = Brand::orderBy('name')->where('sub_category_id', $sub)->get();
        }

        if (!$category_id && !$sub) {
            $brands = Brand::orderBy('name')->get();
        }

        return response()->json([
            'sub' => $sub_categories,
            'brands' => $brands
        ], 200);
    }
}
