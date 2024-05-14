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
        Schema::create('asign_seats', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('shift_id');
            $table->integer('pament_status');
            $table->integer('pament_mode');
            $table->integer('paid_amount');
            $table->integer('discount');
            $table->integer('amount');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asign_seats');
    }
};
