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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('p_name');
            $table->string('p_categry_id');
            $table->string('p_description');
            $table->string('p_type_id');
            $table->string('p_variation');
            $table->string('p_var_value');
            $table->string('p_price');
            $table->string('p_qty');
            $table->string('p_discout_type');
            $table->string('p_discout');
            $table->string('p_image');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
