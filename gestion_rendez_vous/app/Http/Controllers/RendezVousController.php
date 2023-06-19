<?php

namespace App\Http\Controllers;

use App\Models\Heure;
use App\Models\RendezVous;
use App\Models\TimeSlots;
use Illuminate\Http\Request;
use Spatie\Ignition\ErrorPage\Renderer;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rendezVouss = RendezVous::all();
        return view('secretaire.dashboard')->with(compact('rendezVouss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createRendezVous()
    {
        $timeSlots = TimeSlots::all();
        $heures = Heure::all();
        return view('secretaire.createrendezvous')->with(compact('timeSlots', 'heures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
