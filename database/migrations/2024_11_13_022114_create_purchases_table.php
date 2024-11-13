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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->nullable()->constrained(
                table: 'users', indexName: 'purchases_user_id'
            );
        });

        Schema::create('item_purchase', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('item_id')->nullable()->constrained(
                table: 'items', indexName: 'item_id'
            );
            $table->foreignId('purchase_id')->nullable()->constrained(
                table: 'purchases', indexName: 'purchase_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
