<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



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
