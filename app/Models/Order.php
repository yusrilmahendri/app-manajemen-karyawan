<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Profesi;

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
    ];


    public function markAsCompleted()
    {
        if (!$this->isCompleted()) {
            $this->update(['qty' => $this->qty += 1]);
            return true;
        }

        return false;
    }

    public function isCompleted()
    {
        return $this->qty > 0;
    }

    public function profesis()
    {
        return $this->belongsToMany(Profesi::class, 'order_user')->withTimestamps();
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'order_user')->withTimestamps();
    }
    
    
}
