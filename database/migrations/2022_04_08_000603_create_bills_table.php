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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->integer('tenant_id');
            $table->string('bill_type');
            $table->integer('prev_reading')->nullable();
            $table->integer('curr_reading')->nullable();
            $table->integer('amount_balance');
            $table->date('billing_date_prev')->nullable();
            $table->date('billing_date_curr')->nullable();
            $table->date('due_date');
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
        Schema::dropIfExists('bills');
    }
};
