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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
//            $table->foreignId('product_id')->constrained()->onDelete('cascade');
//            $table->foreignId('category_id')->constrained()->onDelete('cascade');
//            $table->integer('amount');
            $table->string('name');
            $table->string('phone', 10);
            $table->string('address');
            $table->date('order_date');
            $table->date('shipping_date');

            $table->integer('amount')->nullable();
            $table->double('total', 10,2)->nullable();
            $table->double('discount',10,2)->default(0);
            $table->string('shop_code');
            $table->double('withholding_tax',10,2)->default(0);
            $table->double('sub_total', 10,2)->nullable();
            $table->double('vat', 10,2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
