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
        return $this->belongsTo(Status::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function getPriceAttribute($value){
        return $value / 100;
    }
    public function setPriceAttribute($value){
        $this->attributes['price'] = $value * 100;
    }
}
