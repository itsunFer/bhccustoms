<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\Event;
use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CompetenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competencias = Competencia::all();
        return view('competencias.indexCompetencia', compact('competencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Competencia::class);
        return view('competencias.createCompetencia');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Competencia::class);
        $request->validate([
            'nombre_c' => ['required', 'max:255'],
            'tipo_c' => ['required', 'min:1', 'max:3'],
        ]);
        Competencia::create($request->all()); 
        return redirect('competencia');
    }

    /**
     * Display the specified resource.
     */
    public function show(Competencia $competencia)
    {
       $events= Event::with('paises')->where('competencias_id', '=', $competencia->id)->get();
        return view('competencias.showCompetencia', compact('competencia', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competencia $competencia)
    {
        $this->authorize('update', $competencia);
        return view('competencias.editCompetencia', compact('competencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competencia $competencia)
    {
        $this->authorize('update', $competencia);
        $request->validate([
            'nombre_c' => ['required', 'max:255'],
            'tipo_c' => ['required', 'min:1', 'max:3'],
        ]);

        Competencia::where('id', $competencia->id)->update($request->except('_token', '_method')); /*Searchs up for the gymnast and updates it with the request exceptuating the token and method*/

        return redirect()->route('competencia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competencia $competencia)
    {
        $this->authorize('delete', $competencia);
        $competencia->delete();
        return redirect()->route('competencia.index');
    }
}
