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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('payment_id');
            $table->dateTime('membership_started_on')->nullable();
            $table->dateTime('membership_end_on')->nullable();
            $table->string('membership_validity_type')->comment('weekly, monthly, yearly')->default('yearly');
            $table->integer('membership_validity_days')->default(365);
            $table->integer('member_status')->default(0)->comment('1=paid, 0=not paid');
            $table->timestamps();


           // $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('payment_id')->references('id')->on('payment_processors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberships');
    }
};
