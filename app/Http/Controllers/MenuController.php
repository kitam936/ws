<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class MenuController extends Controller
{
    public function menu()
    {
        $userId = User::findOrFail(Auth::id())->id;

        $login_user = Auth::user(); // ← これの方が安全



        // dd($reports,$comments,$login_user);

        return Inertia::render('Menu', [

            'login_user' => $login_user,
        ]);
    }

    public function welcome()
    {

        return Inertia::render('Welcome');
    }
}
