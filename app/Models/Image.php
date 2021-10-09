<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    // imageable_id => A que imagen pertenece
    // imageable_type => A que modelo se pertenece
    protected $fillable = ['url', 'imageable_id','imageable_type'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
