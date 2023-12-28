<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $user = Auth::user();
        $userProfesis = $user->profesis;
        $orderProfesis = $order->profesi;
        $userProfesiNames = $userProfesis->pluck('name')->toArray();
        $orderProfesiNames = $orderProfesis->pluck('name')->toArray();
        $commonProfesiNames = array_intersect($userProfesiNames, $orderProfesiNames);

        foreach ($commonProfesiNames as $commonProfesiName) {
            // Periksa apakah qty sudah mencapai 1 sebelum menambahkan
            switch ($commonProfesiName) {
                case 'Desainer':
                    if ($order->qty_desainer < 1) {
                        $order->qty_desainer += 1;
                    }
                    break;
                case 'DTF':
                    if ($order->qty_dtf < 1) {
                        $order->qty_dtf += 1;
                    }
                    break;
                case 'Konika':
                    if ($order->qty_konika < 1) {
                        $order->qty_konika += 1;
                    }
                    break;
                case 'Laser':
                    if ($order->qty_laser < 1) {
                        $order->qty_laser += 1;
                    }
                    break;
                case 'Outdor':
                    if ($order->qty_outdor < 1) {
                        $order->qty_outdor += 1;
                    }
                    break;
            }
        }
        if (
            $order->qty_desainer == 1 &&
            $order->qty_dtf == 1 &&
            $order->qty_konika == 1 &&
            $order->qty_laser == 1 &&
            $order->qty_outdor == 1
        ) {
            return redirect()->back()->with('danger', 'Order telah diselesaikan sebelumnya.');
        }
        $order->save();
        return redirect()->back()->with('success', 'Order Selesai');
    }









}
