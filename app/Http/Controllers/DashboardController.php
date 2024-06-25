<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        /** PIE CHART */
        $rows = Product::selectRaw('category_name, COUNT(*) AS total')
            ->join('categories', 'categories.category_id', 'products.category_id')
            ->groupBy('category_name')->get();
        $pie = [];
        foreach ($rows as $row) {
            $pie[] = [
                'name' =>  $row->category_name,
                'y' =>  $row->total,
            ];
        }
        $rows = OrderDetail::selectRaw('MAX(order_date) AS order_date, SUM(quantity) AS total')
            ->join('orders', 'orders.order_id', 'order_details.order_id')
            ->groupByRaw('YEAR(order_date), MONTH(order_date)')->get();

        /** LINE CHART */
        $line = [];
        foreach ($rows as $row) {
            $line['categories'][] = date('M-Y', strtotime($row->order_date));
            $line['data'][] = $row->total * 1;
        }
        $rows = OrderDetail::selectRaw('category_name, YEAR(order_date) AS order_date, SUM(quantity) AS total')
            ->join('orders', 'orders.order_id', 'order_details.order_id')
            ->join('products', 'products.product_id', 'order_details.product_id')
            ->join('categories', 'categories.category_id', 'products.category_id')
            ->groupByRaw('category_name, YEAR(order_date)')->get();

        /** PIE CHART */
        $column = [];
        foreach ($rows as $row) {
            $column['categories'][$row->order_date] = $row->order_date;
            $column['series'][$row->category_name]['name'] = $row->category_name;
            $column['series'][$row->category_name]['data'][$row->order_date] = $row->total * 1;
        }
        foreach ($column['series'] as $key => $val) {
            $column['series'][$key]['data'] = array_values($val['data']);
        }
        $column['categories'] = array_values($column['categories']);
        $column['series'] = array_values($column['series']);
        return view('home', ['title' => 'Audit'], compact('pie', 'line', 'column', ));





    }
}