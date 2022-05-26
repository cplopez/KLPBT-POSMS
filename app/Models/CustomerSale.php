<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSale extends Model
{
    use HasFactory;
    protected $table = 'customer_sales';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }
    public function m_o_p() {
        return $this->belongsTo('App\Models\MOP');
    }
}
