<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shohin;

class Unit extends Model
{
    /** @use HasFactory<\Database\Factories\UnitFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'unit_code',
        'season_id',
        'season_name',

    ];


    public function shohin()
    {
        return $this->hasMany(Shohin::class);
    }
}
