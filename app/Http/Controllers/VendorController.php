<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Throwable; // 追加
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $login_user = Auth::user(); // ← これの方が安全
        $vendors = Vendor::searchVendors($request->search)
        ->where('vendors.is_working', 'like', '%' . $request->is_working . '%')
        ->where('vendors.id','>=',8000)
        ->where('vendors.id','<',9000)
        ->select(
            'vendors.id as vendor_id',
            'vendors.vendor_name',
            'vendors.vendor_info',
            'vendors.is_working',
        )
        ->orderBy('vendors.id', 'asc')
        ->paginate(50)
        ->withQueryString();


        // dd($vendors, $areas, $companies);

        return Inertia::render('Vendors/Index', [
            'vendors' => $vendors,

            'login_user' => $login_user,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
