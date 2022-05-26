<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    use HasFactory;
    protected $table = 'beverages';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function purchases() {
        return $this->hasMany('App\Models\Purchase');
    }

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}
