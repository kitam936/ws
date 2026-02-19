<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;
use App\Models\Shohin;


class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'sales_date',
        'kubun_id',
        'shop_id',
        'shohin_id',
        'pcs',
        'cost',
        'kingaku',
        'arari',
        'YM',
        'YW',
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

    public function scopeYms($q)
    {
        $YWs=DB::table('sales')
        ->select(['YW','YM'])
        ->groupBy(['YW','YM'])
        ->orderBy('YM','desc')
        ->orderBy('YW','desc');
        return $q;
    }

}
