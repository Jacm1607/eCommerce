<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $fillable = ['province_id', 'name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function delivery_methods()
    {
        return $this->belongsToMany(DeliveryMethod::class);
    }
}
