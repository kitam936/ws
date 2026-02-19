<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /** @use HasFactory<\Database\Factories\VendorFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'vendor_name',
        'vendor_info',
        'is_working',
    ];

    public function scopeSearchVendors($query, $search)
    {
        if ($search) {
            return $query->where('vendor_name', 'like', '%' . $search . '%')
                         ->orWhere('vendor_info', 'like', '%' . $search . '%');
        }
        return $query;
    }
}
