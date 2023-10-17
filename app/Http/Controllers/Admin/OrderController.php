<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Profesi;

class OrderController extends Controller
{

    public function data($id)
    {
        $user = User::where('role', 'user')
                    ->where('id', $id)
                    ->with('profesis')
                    ->first();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    public function datas($id)
    {
        $user = User::where('role', 'user')
                    ->where('id', $id)
                    ->with('profesis')
                    ->first();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }



    public function index(){
        return view('admin.order.index');
    }

    public function create(){
        $users = User::where('role', 'user')->with('profesis')->orderBy('created_at')->get();
        return view('admin.order.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_pelanggan' => 'required|min:2',
            'name_jasa' => 'required|min:2',
            'category' => 'required',
            'price' => 'required|min:2|numeric',
            'deadline' => 'required',
            'user_id' => 'array',
            'profesi_id' => 'array',
        ]);

        $order = Order::create([
            'name_pelanggan' => $request->name_pelanggan,
            'name_jasa' => $request->name_jasa,
            'category' => $request->category,
            'price' => $request->price,
            'deadline' => $request->deadline,
        ]);

        $getCategory = $order->category;

        if ($getCategory == 'umum') {
            if ($request->has('user_id') && is_array($request->user_id) && $request->has('profesi_id') && is_array($request->profesi_id)) {
                if (count($request->user_id) === count($request->profesi_id)) {
                    $userProfesiPairs = array_combine($request->user_id, $request->profesi_id);

                    foreach ($userProfesiPairs as $userId => $profesiId) {
                        $order->users()->attach($userId, ['profesi_id' => $profesiId]);
                    }
                } else {
                    return redirect()->back()->with('error', 'Jumlah user_id dan profesi_id tidak cocok.');
                }
            } else {
                return redirect()->back()->with('error', 'Data user_id dan profesi_id tidak valid atau tidak lengkap.');
            }
        } else {
            if ($request->has('user_id') && is_array($request->user_id) && $request->has('profesi_id') && is_array($request->profesi_id)) {
                $userId = $request->user_id[0];
                $profesiId = $request->profesi_id[0];

                $user = User::find($userId);
                $profesi = Profesi::find($profesiId);
                if ($user && $profesi) {
                    $order->users()->attach($userId, ['profesi_id' => $profesiId]);
                    return redirect()->route('admin.orders')->with('success', 'Order Berhasil di Daftarkan!');
                } else {
                    return redirect()->route('admin.orders')->with('error', 'User atau Profesi tidak valid.');
                }
            }
            return redirect()->route('admin.orders')->with('success', 'Order Berhasil di Daftarkan!');
        }
        return redirect()->route('admin.orders')->with('success', 'Order Berhasil di Daftarkan!');
    }



    public function edit($id)
    {
        $order = Order::with('users.orders')->find($id);
        $users = User::whereHas('orders', function ($query) use ($id) {
            $query->where('order_id', $id); // Specify the table alias 'orders'
        })->get();

        return view('admin.order.edit', compact('order', 'users'));
    }



    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required|min:2',
            'price' => 'required|min:2',
            'deadline' => 'required|min:3',
            'user_id' => 'array',
        ]);

        $order = Order::findOrFail($id);
        $order->category = $request->input('category');
        $order->price = $request->input('price');
        $order->deadline = $request->input('deadline');
        $order->save();

        // Sync the users associated with the order based on the user_id array
        if ($request->has('user_id')) {
            $order->users()->sync($request->user_id);
        } else {
            return redirect()->back()->with('danger', 'Data gagal diubah');
        }

        return redirect()->route('admin.orders')->with('info', 'Pesanan telah berhasil diperbarui.');
    }



    public function destroy($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders')->with('danger', 'Berhasil di Hapus!');
    }
}
