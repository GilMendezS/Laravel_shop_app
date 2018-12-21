<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use softDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'featured',
        'price',
        'inlimited',
        'stock',
        'number',
        'brand',
        'barcode',
        'status_id',
        'weight'
    ];
    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
}
