<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Event;
use App\Models\Score;
use App\Models\Competencia;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Event::class); 
        $request->validate([
             'nombre_e' => ['required', 'max:255'],
            'fecha_i_e'=> ['required', 'date'],
            'fecha_f_e'=> ['required', 'date'],
            'paises_id'=> ['required', 'exists:paises,id'],
            'competencias_id'=>['required', 'exists:competencias,id'],
        ]);
        $request['user_id'] = Auth::user()->id;
        Event::create($request->all());
        return redirect()->route('competencia.show', $request->competencias_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //$scores= Score::with(['gimnastas', 'events', 'rounds', 'aparatos'])->where('events_id', '=', $event->id)->get();
        return view('scores.scoresIndex', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        $paises = Pais::orderBy('nombre_p')->get();
        $competencias = Competencia::all();
        return view('events.editEvent', compact('paises', 'event', 'competencias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {   
        if (Auth::user()->cannot('update', $event)) {
            abort(404);
       }
       if ($response->allowed()) {
            $request->validate([
                'nombre_e' => ['required', 'max:255'],
                'fecha_i_e'=> ['required', 'date'],
                'fecha_f_e'=> ['required', 'date'],
                'paises_id'=> ['required', 'exists:paises,id'],
                'competencias_id'=>['required', 'exists:competencias,id'],
            ]);
                
            Event::where('id', $event->id)->update($request->except('_token', '_method')); /*Searchs up for the gymnast and updates it with the request exceptuating the token and method*/

            return redirect()->route('competencia.show', $request->competencias_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        
        $event->delete();
        return redirect()->route('competencia.index');
    }

    public function newEvent(Competencia $competencia)
    {
        $this->authorize('create', Event::class);
        $paises = Pais::orderBy('nombre_p')->get();
        return view('events.createEvent', compact('paises', 'competencia'));
    }

    public function controlI(Event $event)
    {
        if (Auth::user()->cannot('control', $event)) {
            abort(404);
        }
        $scores= Score::with(['gimnastas', 'events', 'rounds', 'aparatos'])
        ->where('events_id', $event->id)
        ->where('approved', 0) //solo regresa los registros no aprobados
        ->where('edited', 0)
        ->orderBy('total_s', 'desc')
        ->orderBy('execution_s', 'desc')
        ->orderBy('difficulty_s', 'desc')
        ->get();
        return view('events.controlI', compact('event', 'scores'));
    }
}
