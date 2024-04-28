<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('month');
            $table->integer('year');
            $table->boolean('paid')->default(false);
            $table->decimal('amount', 10, 2)->default(0.00); // Adding the 'amount' column
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
