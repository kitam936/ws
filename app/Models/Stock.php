<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\Shohin;

class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StockFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'shop_id',
        'shohin_id',
        'zaiko_pcs',
        'zaiko_cost',
        'zaiko_gedai',
        'zaiko_baika',
        'YM'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function shohin()
    {
        return $this->belongsTo(Shohin::class);
    }
}
