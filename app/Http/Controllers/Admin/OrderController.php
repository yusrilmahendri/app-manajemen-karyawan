<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

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

    public function store(Request $request){

        $this->validate($request, [
            'name_pelanggan' => 'required|min:2',
            'name_jasa' => 'required|min:2',
            'price' => 'required|min:2',
            'deadline' => 'required',
        ]);

        $order = Order::create([
            'name_pelanggan' => $request->name_pelanggan,
            'name_jasa' => $request->name_jasa,
            'price' => $request->price,
            'deadline'  => $request->deadline
        ]);
        

        // Menghubungkan pengguna dan profesi dengan pesanan
        foreach ($request->user_id as $userId) {
            // Retrieve the user
            $user = User::find($userId);
        
            // Check if the user exists and has associated professions
            if ($user && $user->profesis->count() > 0) {
                // Iterate over the user's professions and attach them to the order
                foreach ($user->profesis as $profesi) {
                    $profesiId = $profesi->id;               
                    // Attach the user to the order with the 'profesi_id' and 'order_id'
                    $order->users()->attach($userId, ['profesi_id' => $profesiId, 'order_id' => $order->id]);

                }
            } else {
                return redirect()->back()->with('danger','Data Gagal di ubah');
            }
        }
        
        return redirect()->route('admin.orders')->with('success', 'Order Berhasil di Daftarkan!');

    }


    public function edit($id)
    {
        $order = Order::with('users.profesis.orders')->find($id);
        $users = User::whereHas('orders', function ($query) use ($id) {
            $query->where('order_id', $id); // Specify the table alias 'orders'
        })->get();
    
        return view('admin.order.edit', compact('order', 'users'));
    }
    
    
  
    public function update(Request $request, $id){
        $this->validate($request, [
            'category' => 'required|min:2',
            'price' => 'required|min:2',
            'deadline' => 'required|min:3',
        ]);

        $order = Order::findOrFail($id);
        $order->category = $request->input('category');
        $order->price = $request->input('price');
        $order->deadline = $request->input('deadline');
        $order->save();

        foreach ($request->user_id as $userId) {
            // Retrieve the user
            $user = User::find($userId);
        
            // Check if the user exists and has associated professions
            if ($user && $user->profesis->count() > 0) {
                // Iterate over the user's professions and attach them to the order
                foreach ($user->profesis as $profesi) {
                    $profesiId = $profesi->id;               
                    // Attach the user to the order with the 'profesi_id' and 'order_id'
                    $order->users()->sync($userId, ['profesi_id' => $profesiId, 'order_id' => $order->id]);

                }
            } else {
               return redirect()->back()->with('danger','Data gagal di ubah');
            }
        }

        return redirect()->route('admin.orders')->with('info', 'Pesanan telah berhasil diperbarui.');
    }
    

    public function destroy($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders')->with('danger', 'Berhasil di Hapus!');
    }
}
