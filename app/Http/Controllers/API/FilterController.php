<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function subCategories(Request $request)
    {
        $category_id = $request->input('category');
        $sub_categories = SubCategory::orderBy('name')->where('product_category_id', $category_id)->get();

        return response()->json($sub_categories);
    }
}
