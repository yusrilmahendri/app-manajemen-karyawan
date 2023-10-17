<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function setting()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Load the user's professions using the relationship
        $user->load('profesis');

        // Return the view with the user's data
        return view('user.setting.index', compact('user'));
    }

    public function index(){
        return view('user.task.index');
    }

    //has to bug errors here profesi
    public function show($id){
        $order = Order::with('users.profesis')->findOrFail($id);
        return view('user.task.show', compact('order'));
    }

    public function completeOrder(Order $order)
    {
        if ($order->markAsCompleted()) { // Hapus parameter yang tidak diperlukan
            return redirect()->back()->with('success', 'Order telah selesai.');
        }

        return redirect()->back()->with('danger', 'Order telah selesai sebelumnya.');
    }
}
