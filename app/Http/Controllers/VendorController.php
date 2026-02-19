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


        // dd($vendors, $areas, $vendors);

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
        return Inertia::render('Vendors/Create', [
            'old' => session()->getOldInput(),
            'errors' => session('errors') ? session('errors')->getBag('default')->getMessages() : [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        $request->validate([
            'vendor_name' => ['required', 'string', 'max:255'],
            'vendor_id' => ['required'],
            'vendor_info' => ['string', 'max:255'],

            // 'is_working' => ['required', 'boolean'],
        ]);

        // dd($request->all());

        try{
            DB::transaction(function()use($request){
                Vendor::create([
                    'id' => $request->vendor_id,
                    'vendor_name' => $request->vendor_name,
                    'vendor_info' => $request->vendor_info,
                    'is_working' => 1,
                ]);

            },2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return to_route('vendors.index')->with(['message'=>'登録されました','status'=>'info']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
            // ユーザーの詳細を取得
            $login_user = Auth::user(); // ← これの方が安全

            $vendor = DB::table('vendors')
            ->where('vendors.id', $vendor->id)
            ->select(
                'vendors.id as vendor_id',
                'vendors.vendor_name',
                'vendors.vendor_info',
                'vendors.is_working',
            )

            ->first();


            return Inertia::render('Vendors/Show', [
                'vendor' => $vendor,
                'login_user' => $login_user,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return Inertia::render('Vendors/Edit', [
            'vendor' => $vendor,
            'old' => session()->getOldInput(),
            'errors' => session('errors') ? session('errors')->getBag('default')->getMessages() : [],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $request->validate([
            // 'id' => ['required', 'exists:shops,id'],
            'vendor_name' => ['required', 'string', 'max:255'],
            'vendor_info' => ['string', 'max:255'],
            'is_working' => ['required', 'boolean'],
        ]);

        $vendor = Vendor::findOrFail($vendor->id);

        // dd($request->all(), $vendor);

        try{
            DB::transaction(function()use($request, $vendor){
                $vendor->update([
                    'id' => $request->vendor_id,
                    'vendor_name' => $request->vendor_name,
                    'vendor_info' => $request->vendor_info,
                    'is_working' => $request->is_working,
                ]);
            },2);
        }
        catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return to_route('vendors.index')->with(['message'=>'更新されました','status'=>'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return to_route('vendors.index')->with(['message'=>'削除されました','status'=>'alert']);
    }
}
