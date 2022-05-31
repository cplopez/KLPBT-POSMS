<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'products';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function beverages() {
        return $this->hasMany('App\Models\Beverage');
    }

    public function supplier() {
        return $this->hasMany('App\Models\Supplier');
    }
    public function purchase() {
        return $this->hasMany('App\Models\Purchase');
    }
      public function inventories() {
        return $this->hasMany('App\Models\Inventory');
    }

    public function deliveries() {
        return $this->hasMany('App\Models\Delivery');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}
