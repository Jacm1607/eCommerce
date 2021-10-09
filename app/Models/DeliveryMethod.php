<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function pay_methods()
    {
        return $this->belongsToMany(PayMethod::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
