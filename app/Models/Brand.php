<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shohin;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'brand_name',
        'brand_info',
    ];


    public function shohin()
    {
        return $this->hasMany(Shohin::class);
    }
}
