<?php

namespace App\Http\Controllers;

use App\Models\Heure;
use App\Models\Medecin;
use App\Models\TimeSlots;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Faker\Core\DateTime as CoreDateTime;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$medecins = Medecin::medecins()->get();

        return view('medecin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createDisponibility()
    {
        $users = User::all();
        //dd($medecins);
        $dates = ['2023-06-15', '2023-06-16', '2023-06-17', '2023-06-18', '2023-06-19', '2023-06-20', '2023-06-21',
                    '2023-06-22', '2023-06-23', '2023-06-24', '2023-06-25', '2023-06-26', '2023-06-27', '2023-06-28', '2023-06-29', '2023-06-30',];
        // $heuresDebuts = ['09:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00',];
        // $heuresFins = ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
        $heures = Heure::all();

        return view('admin.createdisponibile')->with(compact('users', 'dates', 'heures'));
    }

    public function verifierDisponibilite(Request $request)
{
    $medecinId = $request->input('dispoMed');
    $date = $request->input('dates');
    $heureDebut = $request->input('heureDebut');
    dd($medecinId, $date, $heureDebut);

    // Votre logique de vérification ici

    // Logique pour vérifier la disponibilité de l'heure de début
    // Effectuez votre requête à la base de données ou appliquez vos conditions métier ici

    $heureDebutDisponible = true; // Exemple de résultat de vérification

    $existingDispo = TimeSlots::where('user_id', $medecinId)->where('date', $date)
            ->where('start_time', $heureDebut);
    if($existingDispo){
        $heureDebutDisponible = false;
    }

    return response()->json(['disponible' => $heureDebutDisponible]);
}
    // ...

    /**
     * Store a newly created resource in storage.
     */
    public function storeDispo(Request $request)
    {
        //dd(date('Y-m-d', strtotime($request->input('dates'))));
        $timeSlots = TimeSlots::all();
        foreach($timeSlots as $timeSlot){
            if($timeSlot->user_id == $request->medecinID){
                if(new DateTime($timeSlot->date) == new DateTime($request->dates)){

                    if(new DateTime($timeSlot->start_time) == new DateTime($request->heureDebut)){
                        if(new DateTime($timeSlot->end_time) == new DateTime($request->heureFin)){
                            return back()->with('erreur', 'Cette horaire a déja une été dédiée a un Rendez-vous');
                        }
                    }
                }
            }
        }

        $timeSlot = new TimeSlots();
        $timeSlot->user_id = intval($request->medecinID);
        $timeSlot->date = date('Y-m-d', strtotime($request->input('dates')));
        $timeSlot->start_time = $request->heureDebut;
        $timeSlot->end_time = $request->heureFin;
        //$timeSlot->disponible = true;
        $timeSlot->save();
        return redirect('/admin/dashboard')->with('flash_message', 'disponibilité ajoutée');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
