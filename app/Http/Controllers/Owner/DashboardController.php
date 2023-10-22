<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $totalUsersWithRole = User::where('role', 'user')->count();
        return view('owner.dashboard', [
            'totalUser' => $totalUsersWithRole
        ]);
    }
}
