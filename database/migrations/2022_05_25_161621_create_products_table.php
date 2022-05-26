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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('beverage_name');
            $table->double('new_quantity', 10,2);
            $table->double('total_quantity', 10,2);
            $table->double('price_case', 10,2);
            $table->double('price_solo', 10,2);
            $table->date('date_expire');
            $table->integer('badorder');
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
        Schema::dropIfExists('products');
    }
};
