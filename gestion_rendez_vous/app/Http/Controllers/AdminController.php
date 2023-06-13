<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Secretaire;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medecins = Medecin::all();
        $secretaires = Secretaire::all();
        return view('admin.dashboard')->with(compact('medecins', 'secretaires'));
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createMedecin(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => '1',
            'password' => Hash::make('password'),
        ]);
    }
    public function createSecretaire()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMedecin(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->createMedecin($request->all())));


        //$this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect($this->redirectPath());
        return redirect('/admin/create')->with('flash_message', 'etudiant ajouté');
    }
    public function storeSecretaire(Request $request)
    {
        $secretaire = new Secretaire();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function essai()
    {
        return view('admin.createmedecin');
    }
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
