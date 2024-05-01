<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('original_price', 10, 2);
            $table->decimal('discount_percentage', 5, 2);
            $table->string('background_image')->nullable();
            $table->string('product_code')->nullable(); // Assuming 'duration' is now 'product_code'
            $table->decimal('discounted_price', 10, 2)->nullable(); // Move this line up
            $table->integer('total_available_tickets')->nullable(); 
            $table->text('description')->nullable(); 
            $table->date('start_date')->nullable();// Add this line to create the 'description' column
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
        Schema::dropIfExists('packages');
    }
}
