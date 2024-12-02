<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\changeScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->cannot('viewAny', changeScore::class)) {
            abort(404);
        }
        return view('scores.controlEditScores');
    }

    public function aproveE(changeScore $changeScore)
    {
        $this->authorize('approve', $changeScore);
        $original = Score::where('id', $changeScore->old_id)->first();  //obtiene el registro original
        $new = Score::where('id', $changeScore->new_id); //obtiene el registro nuevo
        $originalId = $original->id; //guarda el id del registro original

        $more = changeScore::where('old_id', $originalId) //carga todos los registros que son una edición del registro original
        ->get();


        $original->forceDelete(); //elimina el registro original
        
        $new->update(['approved' => true]); //aprueba el nuevo registro
        $new->update(['edited' => false]); //quita el estado de edición
        $new->update(['id' => $originalId]); //cambia el ID del nuevo registro por el ID del registro original

        
        foreach($more as $mor){
            $deleted = Score::where('id', $mor->new_id)->forceDelete(); //elimina todos los registros a espera de edición que estaban ligados al original
        }
        

        return redirect()->route('changescore.index');
        
    }

    public function denyE(changeScore $changeScore)
    {
        $new = Score::where('id', $changeScore->new_id); //obtiene el registro nuevo
        $new->forceDelete(); //elimina el registro original
        return redirect()->route('changescore.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(changeScore $changeScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(changeScore $changeScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, changeScore $changeScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(changeScore $changeScore)
    {
        //
    }
}
