<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function purchases() {
        return $this->hasMany('App\Models\Purchase');
    }

    public function beverages() {
        return $this->hasMany('App\Models\Beverage');
    }

    public function deliveries() {
        return $this->hasMany('App\Models\Delivery');
    }

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function inventories() {
        return $this->hasMany('App\Models\Inventory');
    }
    public function products() {
        return $this->hasMany('App\Models\Product');
    }
}
