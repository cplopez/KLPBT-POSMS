<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier');
    }
}
