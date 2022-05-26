<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOP extends Model
{
    use HasFactory;
    protected $table = 'm_o_p_s';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function customer_sales() {
        return $this->hasMany('App\Models\CustomerSale');
    }
}
