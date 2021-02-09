<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\order;
use App\Product;
use App\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
/**
 * @group  Dashboard
 *
 * APIs for Managing User Dashboard.
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_orders  = order::get()->count();
        $total_sales = order::get()->sum('total_price');
        $pending_orders =  order::where('status','pending')->count();
        $delivered_orders = order::where('status','delivered')->count();
        $data = array(
            'total_orders' => $total_orders,
            'total_sales' => $total_sales,
            'pending_orders' =>  $pending_orders,
            'delivered_orders' =>  $delivered_orders,
        );
        return ['data' => $data];
    }
    public function UserDash()
    {
        $user_id = auth()->user()->id;
        $total_orders  = Shipment::where('seller_id', $user_id)->get()->count();
        $total_sales =Shipment::where('seller_id', $user_id)->get()->sum('total');
        $pending_orders = Shipment::where('seller_id', $user_id)->where('status','placed')->count();
        $delivered_orders = Shipment::where('seller_id', $user_id)->where('status','delivered')->count();
        $data = array(
            'total_orders' => $total_orders,
            'total_sales' => $total_sales,
            'pending_orders' =>  $pending_orders,
            'delivered_orders' =>  $delivered_orders,
        );
        return ['data' => $data];
    }
    public function UserDashboard()
    {
        $user_id = auth()->user()->id;
        $total_orders  = Shipment::where('seller_id', $user_id)->get()->count();
        $total_sales =Shipment::where('seller_id', $user_id)->get()->sum('total');
        $total_instock = Product::where('user_id', $user_id)->where('status',1)->count();
        $total_outOfStock = Product::where('user_id', $user_id)->where('status',0)->count();
        $data = array(
            'total_products' => $total_orders,
            'total_sales' => $total_sales,
            'total_instock' =>  $total_instock,
            'total_outstock' =>  $total_outOfStock,
        );
        return ['data' => $data];
    }
    public function RiderDash()
    {
        $user_id = auth()->user()->id;
        $total_orders  = Shipment::where('rider_id', $user_id)->get()->count();
        $total_sales =Shipment::where('rider_id', $user_id)->get()->sum('deliveryFee');
        $pending_orders = Shipment::where('rider_id', $user_id)->where('status','placed')->count();
        $delivered_orders = Shipment::where('rider_id', $user_id)->where('status','delivered')->count();
        $data = array(
            'total_orders' => $total_orders,
            'total_sales' => $total_sales,
            'pending_orders' =>  $pending_orders,
            'delivered_orders' =>  $delivered_orders,
        );
        return ['data' => $data];
    }
    public function visitors(){
        $visitor = Product::where('status',1)->orderBy('visitors','desc')->with(['subCategory', 'subCategory.brands'])->with('category')->get();
        return $visitor;
    }
    function getAllMonths(){
        $month_array = array();
        $sale_dates = order::groupBy('created_at')->pluck('created_at');
        $sale_dates = json_decode($sale_dates);

        if (!empty($sale_dates)){
            foreach ($sale_dates as $unformated_date) {
                $date = new \DateTime($unformated_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] =$month_name;
            }
        }

        return $month_array;
    }
    function getMonthlySales_count($month){
        $monthly_sales = order::whereMonth('created_at',$month)->get()->count();
        return $monthly_sales;
    }
    function getMonthlySales(){
        $monthly_sales_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)){
            foreach ($month_array as $month_no => $month_name){
               $monthly_sales_count = $this->getMonthlySales_count($month_no);
               array_push($monthly_sales_count_array,$monthly_sales_count);
               array_push($month_name_array,$month_name);
            }
        }
        $max_no = max($monthly_sales_count_array);
        $max = round(($max_no + 10/2) / 10)* 10;
        $monthly_sales_count_array = array(
            'months' => $month_name_array,
            'sales_count' => $monthly_sales_count_array,
            'max'=> $max,
        );
        return $monthly_sales_count_array;
    }

    function getMonthlySalesTotal($month){
        $monthly_sales_value = order::whereMonth('created_at',$month)->get()->sum('total_price');
        return $monthly_sales_value;
    }
    function getMonthlySalesValue(){
        $monthly_sales_value_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)){
            foreach ($month_array as $month_no => $month_name){
                $monthly_sales_value = $this->getMonthlySalesTotal($month_no);
                array_push($monthly_sales_value_array,$monthly_sales_value);
                array_push($month_name_array,$month_name);
            }
        }

        $monthly_sales_count_array = array(
            'months' => $month_name_array,
            'sales_value' => $monthly_sales_value_array,

        );
        return $monthly_sales_count_array;
    }


    function getMonthlyUserSales_count($month){
        $user_id = auth()->user()->id;
        $monthly_sales = Shipment::where('seller_id',$user_id)->whereMonth('created_at',$month)->get()->count();
        return $monthly_sales;
    }
    function getMonthlyUserSales(){
        $monthly_sales_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)){
            foreach ($month_array as $month_no => $month_name){
                $monthly_sales_count = $this-> getMonthlyUserSales_count($month_no);
                array_push($monthly_sales_count_array,$monthly_sales_count);
                array_push($month_name_array,$month_name);
            }
        }
        $max_no = max($monthly_sales_count_array);
        $max = round(($max_no + 10/2) / 10)* 10;
        $monthly_sales_count_array = array(
            'months' => $month_name_array,
            'sales_count' => $monthly_sales_count_array,
            'max'=> $max,
        );
        return $monthly_sales_count_array;
    }
    function getMonthlyUserSalesTotal($month){
        $user_id = auth()->user()->id;
        $monthly_sales_value =  Shipment::where('seller_id',$user_id)->whereMonth('created_at',$month)->get()->sum('total');
        return $monthly_sales_value;
    }
    function getMonthlyUserSalesValue(){
        $monthly_sales_value_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)){
            foreach ($month_array as $month_no => $month_name){
                $monthly_sales_value = $this-> getMonthlyUserSalesTotal($month_no);
                array_push($monthly_sales_value_array,$monthly_sales_value);
                array_push($month_name_array,$month_name);
            }
        }

        $monthly_sales_count_array = array(
            'months' => $month_name_array,
            'sales_value' => $monthly_sales_value_array,

        );
        return $monthly_sales_count_array;
    }

    function getMonthlyDelivery_count($month){
        $user_id = auth()->user()->id;
        $monthly_sales = Shipment::where('rider_id',$user_id)->whereMonth('created_at',$month)->get()->count();
        return $monthly_sales;
    }
    function getMonthlyDelivery(){
        $monthly_delivery_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)){
            foreach ($month_array as $month_no => $month_name){
                $monthly_delivery_count = $this->getMonthlyDelivery_count($month_no);
                array_push( $monthly_delivery_count_array,$monthly_delivery_count);
                array_push($month_name_array,$month_name);
            }
        }
        $max_no = max( $monthly_delivery_count_array);
        $max = round(($max_no + 10/2) / 10)* 10;
        $monthly_delivery_count_array = array(
            'months' => $month_name_array,
            'delivery_count' => $monthly_delivery_count_array,
            'max'=> $max,
        );
        return $monthly_delivery_count_array;
    }
    function getMonthlyUserEarningTotal($month){
        $user_id = auth()->user()->id;
        $monthly_sales_value =  Shipment::where('rider_id',$user_id)->whereMonth('created_at',$month)->get()->sum('deliveryFee');
        return $monthly_sales_value;
    }
    function getMonthlyUserEarning(){
        $monthly_earning_value_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)){
            foreach ($month_array as $month_no => $month_name){
                $monthly_earning_value = $this-> getMonthlyUserEarningTotal($month_no);
                array_push( $monthly_earning_value_array,$monthly_earning_value);
                array_push($month_name_array,$month_name);
            }
        }

        $monthly_earning_value_array = array(
            'months' => $month_name_array,
            'earning_value' => $monthly_earning_value_array,

        );
        return  $monthly_earning_value_array;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
