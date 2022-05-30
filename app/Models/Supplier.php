<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function beverages() {
        return $this->hasMany('App\Models\Beverage');
    }
    public function category() {
        return $this->hasMany('App\Models\Category');
    }

    public function inventories() {
        return $this->hasMany('App\Models\Inventory');
    }

    public function deliveries() {
        return $this->hasMany('App\Models\Delivery');
    }
}
