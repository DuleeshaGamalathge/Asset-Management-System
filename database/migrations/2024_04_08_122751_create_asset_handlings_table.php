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
        Schema::create('asset_handlings', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('asset_id')->constrained('assets');
            $table->foreignId('business_user')->constrained('business_user');
            $table->foreignId('created_by')->constrained('business_user');
            $table->string('given_date');
            $table->foreignId('given_by')->constrained('business_user');
            $table->string('handover_date')->nullable();
            $table->string('handover_to')->nullable();
            $table->integer('status')->default(0);
            $table->foreignId('business_id')->constrained('businesses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_handlings');
    }
};
