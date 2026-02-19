<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Unit;


class Shohin extends Model
{
    /** @use HasFactory<\Database\Factories\ShohinFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'brand_id',
        'unit_id',
        'year_code',
        'shohin_gun',
        'shohin_name',
        'shohin_info',
    ];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }



}
