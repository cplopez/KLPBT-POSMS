<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier');
    }
    public function beverage() {
        return $this->belongsTo('App\Models\Beverage');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
}
