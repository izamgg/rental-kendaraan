<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
   protected $fillable = [
    'user_id',
    'vehicle_id',
    'days',
    'total_price',
    'status' // 🔥 TAMBAHKAN INI
];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}