<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function(Blueprint $table){
            $table->double('withholding_tax',10,2)->default(0);
            $table->double('sub_total', 10,2)->nullable();
            $table->double('vat', 10,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function(Blueprint $table){
            $table->dropColumn('withholding_tax');
            $table->dropColumn('sub_total');
            $table->dropColumn('vat');
        });
    }
};
