<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = ['departament_id', 'name', 'province_order'];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
