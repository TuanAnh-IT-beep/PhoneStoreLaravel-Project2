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
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete(('set null'));
            $table->foreignId('payment_method_id')->constrained();
            $table->string("receiver");
            $table->string("address");
            $table->string("phone");
            $table->string("note")->nullable();
            $table->float("ship_fee")->default(0);
            $table->float("total_price");
            $table->dateTime("ship_expect_date")->nullable();
            $table->dateTime("ship_actual_date")->nullable();
            $table->integer("status")->default(0);
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
