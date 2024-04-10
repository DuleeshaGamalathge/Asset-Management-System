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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_no');
            $table->string('name');
            $table->foreignId('inventory_category_id')->constrained('inventory_categories');
            $table->string('purchased_date');
            $table->string('warranty');
            $table->string('description');
            $table->string('remarks');
            $table->integer('status')->default(0);
            $table->foreignId('created_by')->constrained('business_user');
            $table->foreignId('updated_by')->constrained('business_user');
            $table->foreignId('business_id')->constrained('businesses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
