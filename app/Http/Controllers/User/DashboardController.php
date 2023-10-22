<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user) {
            $totalOrders = $user->orders->count();
        } else {
            $totalOrders = 0;
        }
        return view('user.dashboard', [
            'totalOrders' => $totalOrders
        ]);
    }
}
