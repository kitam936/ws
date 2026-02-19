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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')
            ->constrained();
            $table->foreignId('shohin_id')
            ->constrained();
            $table->bigInteger('zaiko_pcs');
            $table->bigInteger('zaiko_cost');
            $table->bigInteger('zaiko_gedai');
            $table->bigInteger('zaiko_baika');
            $table->integer('YM');
            $table->timestamps();
            // インデックス設定
            $table->index('shop_id', 'idx_shop_id');
            $table->index('shohin_id', 'idx_shohin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
