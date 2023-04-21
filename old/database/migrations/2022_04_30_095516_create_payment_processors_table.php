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
        Schema::create('payment_processors', function (Blueprint $table) {
            $table->id();
            $table->string('tr_id');
            $table->string('payment_id')->nullable();
            $table->string('payment_type')->default(0)->comment('0=ontime, 1=recurring');
            $table->string('captured_currency')->default('USD');
            $table->double('captured_amount')->default(0.00);
            $table->string('payer_name')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('payment_processors');
    }
};
