<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;

class Profesi extends Model
{
    use HasFactory;

    protected $table = 'profesi';

    protected $fillable = ['id', 'name'];

    public function users(){
        return $this->belongsToMany(User::class, 'user_profesi');
    }

    public function getNamedProfesi(){
        return $this->attributes['name'];
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_user', 'profesi_id', 'order_id')
        ->withTimestamps();
    }
}
