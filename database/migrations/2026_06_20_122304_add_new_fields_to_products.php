<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  
        public function up() {
        Schema::table('products', function (Blueprint $table) {
        $table->string('tags')->nullable(); // For the Matcher (e.g. "gaming,budget")
        $table->integer('stock_threshold')->default(5); // For Restock Alerts
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
