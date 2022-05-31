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
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('beverage_name');
            $table->dropColumn('price_case');
            $table->dropColumn('price_solo');
            $table->dropColumn('date_expiry');
            $table->dropColumn('supplier_id');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->foreignId('order_id')->after('id');
            $table->integer('new_quantity')->after('quantity');
            $table->integer('old_quantity')->after('new_quantity');
            $table->integer('quantity')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
