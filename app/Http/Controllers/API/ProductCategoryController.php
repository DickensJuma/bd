<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;
use Image;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCategory::orderBy('name')->get();
    }

    public function featuredCategory()
    {
        return ProductCategory::get()->random(5);
    }

    public function categoriesSubCategoriesBrands(){
        return ProductCategory::orderBy('name')->with(['category','subCategory', 'subCategory.brands'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:product_categories',
            'image' => 'required|string'
        ]);
        $category = new ProductCategory();
        $category->name = $request->name;

        if ($request->image) {
            $ext = explode('/', explode(':', substr($request->image, 0,
                strpos($request->image, ';')))[1])[1];

            if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
                $image = time() . '.' . explode('/', explode(':', substr($request->image, 0,
                        strpos($request->image, ';')))[1])[1];
                \Image::make($request->image)->resize(500, 500)->save(public_path('storage/products_category/') . $image);
            } else {
                $image = 'profile.png';
            }
        }
        $category->image = $image;
        $category->save();

        return response([
            'status' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->name = $request->name;

        if ($request->image) {
            $ext = explode('/', explode(':', substr($request->image, 0,
                strpos($request->image, ';')))[1])[1];

            if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
                $image = time() . '.' . explode('/', explode(':', substr($request->image, 0,
                        strpos($request->image, ';')))[1])[1];
                \Image::make($request->image)->resize(500, 500)->save(public_path('storage/products_category/') . $image);
                $category->image = $image;
            }
        }
        $category->update();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = ProductCategory::findOrFail($id);
        $user->delete();
        return ['message' => 'Category deleted'];
    }
}
