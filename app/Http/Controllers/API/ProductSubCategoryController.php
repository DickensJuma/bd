<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubCategory::with('category')->get();
    }

    public function getSubcategory($id){
        return SubCategory::where('product_category_id', $id)->with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category'=> 'required',
        ]);
        $category = new SubCategory();
        $category->name = $request->name;
        $category->product_category_id = $request->category;
        $category->save();

        return response([
            'status' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'category'=> 'required',
        ]);

        $category = SubCategory::findOrFail($id);
        $category->name = $request->name;
        $category->product_category_id = $request->category;
        $category->update();

        return response([
            'status' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = SubCategory::findOrFail($id);
        $user->delete();
        return ['message'=> 'Category deleted'];
    }
}
