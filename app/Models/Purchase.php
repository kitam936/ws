<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\Shohin;

class Purchase extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'purchase_date',
        'vendor_id',
        'shohin_id',
        'pur_pcs',
        'pur_cost',
        'pur_kingaku',
        'YM',
        'YMD',
        'Y'
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
