<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_sales', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('m_o_p_id');
            $table->double('amount', 10,2);
            $table->string('check_num');
            $table->string('check_date');
            $table->string('bankname');
            $table->double('discount');
            $table->double('check_amount',10,2);
            $table->double('total_quantity', 10, 2);
            $table->double('total_cash', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_sales');
    }
};
