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
            $table->date('purchase_date');
            $table->integer('vendor_id');
            $table->foreignId('shohin_id')
            ->constrained();
            $table->bigInteger('pur_pcs');
            $table->bigInteger('pur_cost');
            $table->bigInteger('pur_kingaku');
            $table->integer('YM');
            $table->integer('YMD');
            $table->integer('Y');
             // インデックス設定
            $table->index('shohin_id', 'idx_shohin_id');
            $table->index('purchase_date', 'idx_purchase_date');                   // 期間検索
            $table->index(['purchase_date', 'shohin_id'], 'idx_date_shohin');   // ランキング用
            $table->index(['vendor_id', 'purchase_date'], 'idx_vendor_date');       // 仕入先集計用
            $table->timestamps();
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
