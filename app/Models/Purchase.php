<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = [];
    
    public function beverage() {
        return $this->belongsTo('App\Models\Beverage');
    }

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }
    public function mop() {
        return $this->belongsTo('App\Models\MOP');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
}
