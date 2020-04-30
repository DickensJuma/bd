<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\User;
use App\WholesalerRetailer;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::latest()->with(array('category' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('brand' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('subcategory' => function ($query) {
            $query->select('id', 'name');
        }))->get(['id', 'title', 'price', 'category_id', 'brand_id', 'sub_category_id', 'uniqueId', 'status']);
    }

    public function shop()
    {
        return $shop = WholesalerRetailer::latest()->get();

    }

    public function getProducts($id)
    {
        return Product::where('brand_id', $id)->with(array('category' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('brand' => function ($query) {
            $query->select('id', 'name');
        }))->get(['id', 'title', 'price', 'category_id', 'brand_id']);
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
            'category' => 'required|integer',
            'subcategory' => 'required|integer',
            'shop' => 'required|integer',
            'brand' => 'required|integer',
            'title' => 'required|string',
            'price' => 'required|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'files' => 'required|array|between:1,15',
            'files.*' => 'image|mimes:jpg,jpeg,png',
            'description' => 'required',
        ]);

        $product = new Product();
        $product->quantity = $request->quantity;
        $product->uniqueId = time();
        $product->category_id = $request->category;
        $product->sub_category_id = $request->subcategory;
        $product->brand_id = $request->brand;
        $product->user_id = $request->shop;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                $ext = $uploadedFile->getClientOriginalExtension();
                if (in_array($ext, ['jpg', 'png', 'jpeg'])) {
//                    $filename = $uploadedFile->storeAs('public/uploads', time() . $uploadedFile->getClientOriginalName());
                    $filename = time() . $uploadedFile->getClientOriginalName();
                    $img = \Image::make($uploadedFile)->resize(255, 255, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('storage/uploads/') . $filename);
                    \Image::make($uploadedFile)->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/storage/uploads/large/') . $filename);
                    $image = new ProductImage();
                    $image->product_id = $product['id'];
                    $image->height = $img->height();
                    $image->path = $filename;
                    $image->save();
                }
            }
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $product = Product::where('uniqueId', $id)->firstOrFail();
        $product->status = $request->status;
        $product->update();

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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required|integer',
            'subcategory' => 'required|integer',
            'brand' => 'required|integer',
            'title' => 'required|string',
            'price' => 'required|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'files' => 'sometimes|array|between:1,15',
            'files.*' => 'image|mimes:jpg,jpeg,png',
            'description' => 'required',
        ]);

        $product = Product::where('uniqueId', $id)->firstOrFail();
        $product->quantity = $request->quantity;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->subcategory;
        $product->brand_id = $request->brand;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->update();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                $ext = $uploadedFile->getClientOriginalExtension();
                if (in_array($ext, ['jpg', 'png', 'jpeg'])) {
//                    $filename = $uploadedFile->storeAs('public/uploads', time() . $uploadedFile->getClientOriginalName());
                    $filename = time() . $uploadedFile->getClientOriginalName();
                    \Image::make($uploadedFile)->resize(360, 360, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/') . $filename);
                    \Image::make($uploadedFile)->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/large/') . $filename);
                    $image = new ProductImage();
                    $image->product_id = $product['id'];
                    $image->height = \Image::make($uploadedFile)->height();
                    $image->path = $filename;
                    $image->save();
                }
            }
        }

        return response([
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
        $product = Product::findOrFail($id);
        $product->delete();

        return response([
            'status' => 'success'
        ], 200);
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $image->delete();

        return response([
            'status' => 'success'
        ], 200);
    }
}
