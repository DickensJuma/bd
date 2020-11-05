<?php

namespace App\Http\Controllers\API;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @group  Brands
 *
 * APIs for Managing Brands
 */
class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Brand::orderBy('name')->with('subcategory.category')->get();
    }

    public function getBrands($id){
        return Brand::orderBy('name')->where('sub_category_id', $id)->with('subcategory.category')->with('product')->get();
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
            'brand' => 'required|string',
            'subcategory' => 'required|integer',
        ]);

        $brand = new Brand();
        $brand->name = $request->brand;
        $brand->sub_category_id = $request->subcategory;
        if ($request->description){
            $brand->description = $request->description;
        }
        $brand->save();
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
            'brand' => 'required|string',
            'subcategory' => 'required|integer',
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $request->brand;
        $brand->sub_category_id = $request->subcategory;
        if ($request->description){
            $brand->description = $request->description;
        }
        $brand->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
    }
}
