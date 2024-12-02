<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Gimnasta;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipos.equipoindex', compact('equipos'));
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
        $request->validate([
            'events_id'=>['required', 'exists:events,id'],
            'paises_id'=>['required', 'exists:paises,id'],
        ]);
        Equipo::create($request->all());
        return redirect()->route('equipo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        $gimnastas = Gimnasta::where('paises_id', $equipo->paises_id)->get();
        return view('equipos.showEquipo', compact('gimnastas', 'equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        $this->authorize('delete', $equipo);
        $equipo->delete();
        return redirect()->route('equipo.index');
    }

    public function adminEquipos(Request $request, Equipo $equipo)
    {
        $this->authorize('delete', $equipo);
        $request->validate([
            'gimnasta_id' => ['required'],
            'alternate_g' => ['required'],
        ]);
        if($request->alternate_g=="true"){
            $val=true;
        }
        else{
            $val=false;
        }
        foreach($request->gimnasta_id as $gim){
            $equipo->gimnastas()->toggle([$gim=> ['alternate_g' => $val]]);
        }
        //dd($gim);
        //$equipo->gimnastas()->toggle($request->gimnasta_id, ['alternate_g' => true]);
        return redirect()->route('equipo.show', $equipo);
    }
}
