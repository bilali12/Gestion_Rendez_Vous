<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Secretaire;
use App\Models\TimeSlots;
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
        $users = User::all();
        $timeSlots = TimeSlots::all();
        return view('admin.dashboard')->with(compact('users', 'timeSlots'));
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
       // dd($data['role']);
        $data['role'] = "1";
        if($data['role'] = "1"){
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => Hash::make('password'),
            ]);
        }
    //     $data['role'] = "1";
    // $password = 'password'; // Définir le mot de passe souhaité ici

    // $user = User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'role' => $data['role'],
    //     'password' => Hash::make($password),
    // ]);

    // if ($data['role'] == '1') {
    //     $medecin = new Medecin([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($password),
    //         // Autres champs spécifiques au médecin
    //     ]);

    //     $user->medecins()->save($medecin);
    // }

    // return $user;

    }
    public function createSecretaire(array $data)
    {
        $data['role'] = "2";
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make('password'),
        ]);
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
        return redirect('/admin/dashboard')->with('flash_message', 'medecin ajouté');
    }
    public function storeSecretaire(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->createSecretaire($request->all())));


        //$this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect($this->redirectPath());
        return redirect('/admin/dashboard')->with('flash_message', 'secretaire ajouté');
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
