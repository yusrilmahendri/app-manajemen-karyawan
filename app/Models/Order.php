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


    public function markAsCompleted()
    {
        $authUser = Auth::user();
        $userProfessions = $authUser->profesis;
        $orderProfessions = $this->profesis->pluck('id')->toArray();

        if (!$this->isCompleted() && $this->users->contains($authUser)) {
            foreach ($userProfessions as $userProfession) {
                if (in_array($userProfession->id, $orderProfessions)) {
                    switch ($userProfession->id) {
                        case 1:
                            $this->update(['qty_konika' => $this->qty_konika + 1]);
                            break;

                        case 2:
                            $this->update(['qty_dtf' => $this->qty_dtf + 1]);
                            break;

                        case 3:
                            $this->update(['qty_desainer' => $this->qty_desainer + 1]);
                            break;

                        case 4:
                            $this->update(['qty_laser' => $this->qty_laser + 1]);
                            break;

                        case 5:
                            $this->update(['qty_outdor' => $this->qty_outdor + 1]);
                            break;
                    }
                }
            }
            return true;
        }
        return false;
    }

    public function isCompleted()
    {
        // Cek apakah ada setidaknya satu user yang memiliki pesanan
        if ($this->users->count() >= 1) {
            // Inisialisasi variabel penanda
            $completed = false;
            // Loop melalui semua profesi pada pesanan
            foreach ($this->profesis as $profession) {
                // Cek apakah jumlah yang di +1 <= 1
                switch ($profession->id) {
                    case 1:
                        if ($this->qty_konika + 1 <= 1) {
                            $completed = true;
                        }
                        break;

                    case 2:
                        if ($this->qty_dtf + 1 <= 1) {
                            $completed = true;
                        }
                        break;

                    case 3:
                        if ($this->qty_desainer + 1 <= 1) {
                            $completed = true;
                        }
                        break;

                    case 4:
                        if ($this->qty_laser + 1 <= 1) {
                            $completed = true;
                        }
                        break;

                    case 5:
                        if ($this->qty_outdor + 1 <= 1) {
                            $completed = true;
                        }
                        break;
                }
            }

            return $completed;
        }

        return false;
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
