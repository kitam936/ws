<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamoku extends Model
{
    /** @use HasFactory<\Database\Factories\KamokuFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'kamoku_name',
        'kamoku_info',
    ];
}
