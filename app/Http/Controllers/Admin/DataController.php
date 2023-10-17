<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class DataController extends Controller
{
    public function order()
    {
        $orders = Order::with('users')->orderBy('created_at', 'asc')->get();

        return datatables()->of($orders)
            ->addColumn('name', function ($order) {
                $names = $order->users->pluck('name')->implode(', ');
                return $names;
            })
            ->addColumn('action', 'admin.order.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }


}
