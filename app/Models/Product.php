<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const PUBLICADO_CON_STOCK = 1;
    const PUBLICADO_SIN_STOCK = 2;
    const BORRADOR  = 0;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
