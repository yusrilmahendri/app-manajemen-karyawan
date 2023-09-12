<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function todo(){
        $auth = Auth::user();
        // $userOrders = $auth->orders()->get();
        $userOrders = $auth->orders()->where('qty', '==', 0)->get();
        if(!$userOrders){
            $userOrders = $auth->orders()->get();
        }
        
        return datatables()->of($userOrders)
            ->addColumn('action', 'user.task.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
    
}
