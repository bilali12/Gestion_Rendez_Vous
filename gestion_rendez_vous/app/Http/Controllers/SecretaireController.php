<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SecretaireController extends Controller
{
    public function index()
    {

        return view('secretaire.dashboard');
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
    public function createRendezVous()
    {
        // dd($data['role']);
        return view('secretaire.createrendezvous');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->createPatient($request->all())));


        //$this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect($this->redirectPath());
        return redirect('/secretaire/dashboard')->with('flash_message', 'medecin ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }
    public function createMed()
    {
        return view('admin.createmedecin');
    }
    public function createSec()
    {
        return view('admin.createsecretaire');
    }
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',

        ]);

        $user->fill($request->post())->save();

        return redirect()->route('admin.index')->with('success','Company Has Been updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(User $user)
    // {
    //     $user->delete();
    //     return redirect()->route('admin.index')->with('success','Company has been deleted successfully');
    // }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'suppression fait avec succes');
    }
}
