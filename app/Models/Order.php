<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders", $guarded=['id','order_status','created_at','updated_at'];

    const PENDIENTE = 1;
    const RECIBIDO = 2;
    const ENVIADO = 3;
    const ENTREGADO = 4;
    const ANULADO = 0;

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function delivery_method()
    {
        return $this->belongsTo(DeliveryMethod::class, 'delivery_method_id', 'id');
    }

    public function pay_method()
    {
        return $this->belongsTo(PayMethod::class, 'pay_method_id', 'id');
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
