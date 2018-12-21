<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;
    protected $table = 'statuses';
    protected $fillable = [
        'title', 'description'
    ];
    public function products(){
        return $this->hasMany(Product::class, 'status_id');
    }
}
