<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'id',
        'name_pelanggan',
        'name_jasa',
        'category',
        'price',
        'deadline',
        'qty_desainer',
        'qty_dtf',
        'qty_konika',
        'qty_laser',
        'qty_outdor',
        'completed',
        'completed_users'
    ];

public function record()
{
    $data = User::where('role', 'user')
        ->with('orders', 'profesis')
        ->orderBy('created_at', 'desc')
        ->get();

    // Create a new array to format the data for DataTables
    $formattedData = [];

    foreach ($data as $user) {
        $qtyDesainer = 0;
        $qtyKonika = 0;
        $qtyOutdor = 0;
        $qtyDtf = 0;
        $qtyLaser = 0;

        foreach ($user->orders as $order) {
            $qtyDesainer += $order->qty_desainer;
            $qtyKonika += $order->qty_konika;
            $qtyOutdor += $order->qty_outdor;
            $qtyDtf += $order->qty_dtf;
            $qtyLaser += $order->qty_laser;
        }

        $formattedData[] = [
            'name' => $user->name,
            'qty_desainer' => $qtyDesainer,
            'qty_konika' => $qtyKonika,
            'qty_outdor' => $qtyOutdor,
            'qty_dtf' => $qtyDtf,
            'qty_laser' => $qtyLaser,
        ];
    }

    return response()->json(['data' => $formattedData]);
}



    public function profesi()
    {
        return $this->belongsToMany(Profesi::class, 'order_user', 'order_id', 'profesi_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
