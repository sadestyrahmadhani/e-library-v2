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
        Schema::create('transaction_penalties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id');
            $table->integer('late');
            $table->double('amount', 8, 2);
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_penalties');
    }
};
