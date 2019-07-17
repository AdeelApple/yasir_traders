<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        // dd(filter($request));
        $filter = filter($request);


        $all = Sale::selectRaw('product_id, products.name as product_name, sum_qty, sum_bonus, avg_unit_price, sum_sales_amount, sum_qty * products.unit_purchase as sum_purchase_amount, sum_sales_amount - (products.unit_purchase * sum_qty) as profit')->from(DB::raw('(select product_id, sum(sales.qty) as sum_qty, sum(sales.bonus) as sum_bonus, AVG(unit_price) avg_unit_price, SUM(discount_total) as sum_sales_amount from sales group by product_id) as groupsales'))->join('products','products.id','product_id')->where($filter)->paginate(20);
        return request()->json('200',$all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }


    public function report(Request $request)
    {
        // dd(filter($request));
        $filter = filter($request);


        $all = Sale::selectRaw('product_id, products.name as product_name, sum_qty, sum_bonus, avg_unit_price, sum_sales_amount, sum_qty * products.unit_purchase as sum_purchase_amount, sum_sales_amount - (products.unit_purchase * sum_qty) as profit')->from(DB::raw('(select product_id, sum(sales.qty) as sum_qty, sum(sales.bonus) as sum_bonus, AVG(unit_price) avg_unit_price, SUM(discount_total) as sum_sales_amount from sales group by product_id) as groupsales'))->join('products','products.id','product_id')->where($filter)->paginate(20);
        return request()->json('200',$all);
        
    }


}
