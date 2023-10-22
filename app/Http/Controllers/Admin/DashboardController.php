<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class DashboardController extends Controller
{
    public function index(){
        $totalOrders = Order::count();

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'totalOrders' => $totalOrders,
        ]);
    }

}
