<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('admin.index');
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role == '0') {
                // Logique spécifique pour l'administrateur
                $users = User::all();
                return view('admin.dashboard')->with(compact('users'));
            } elseif ($user->role == '1') {
                // Logique spécifique pour le médecin
                return view('medecin.index');
            } elseif ($user->role == '2') {
                // Logique spécifique pour la secrétaire
                return view('secretaire.dashboard');
            }
        }

        return view('auth.passwords.login');
    }
}
