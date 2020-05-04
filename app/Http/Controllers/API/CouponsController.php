<?php

namespace App\Http\Controllers\API;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Validation\ValidationException;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Coupon::latest()->get();
    }

    public function applyCoupon(Request $request)
    {
        $this->validate($request, [
            'coupon' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->coupon)->where('status', 'active')->first();

        if (!$coupon) {
            throw ValidationException::withMessages(['coupon' => 'Coupon invalid or expired... Please try again']);
        }

        if ($coupon) {
            $parent = array(
                'unique_id' => $coupon['unique_id'],
                'code' => $coupon['code'],
                'discount' => $coupon->discount($request->total, $coupon['id'])
            );

            return response([
                'status' => 'success',
                'data' => $parent
            ], 200);
        }
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
            'code' => 'required|string|unique:coupons',
            'type' => 'required|string',
            'status' => 'required|string',
            'goods_worth' => 'required|integer'
        ]);

        $coupon = new Coupon();

        if ($request->type == "fixed") {
            $this->validate($request, [
                'discount_amount' => 'required|integer'
            ]);

            $coupon->value = $request->discount_amount;
            $coupon->type = $request->type;
        }

        if ($request->type == "percent") {
            $this->validate($request, [
                'percent_off' => 'required|integer|between:1,100'
            ]);
            $coupon->percent_off = $request->percent_off;
            $coupon->type = $request->type;
        }

        $coupon->code = $request->code;
        $coupon->status = $request->status;
        $coupon->goods_worth = $request->goods_worth;
        $coupon->unique_id = time();
        $coupon->save();

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
        Validator::make($request->all(), [
            'code' => [
                'required',
                'string',
                Rule::unique('coupons')->ignore($id),
            ],
            'type' => ['required', 'string',],
            'goods_worth' => ['required', 'integer',],
            'status' => ['required', 'string',]
        ]);
        $coupon = Coupon::findOrFail($id);

        if ($request->type == "fixed") {
            $this->validate($request, [
                'discount_amount' => 'required|integer'
            ]);

            $coupon->value = $request->discount_amount;
            $coupon->type = $request->type;
        }

        if ($request->type == "percent") {
            $this->validate($request, [
                'percent_off' => 'required|integer|between:1,100'
            ]);
            $coupon->percent_off = $request->percent_off;
            $coupon->type = $request->type;
        }

        $coupon->code = $request->code;
        $coupon->status = $request->status;
        $coupon->goods_worth = $request->goods_worth;
        $coupon->update();

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
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return response([
            'status' => 'success'
        ], 200);
    }
}
