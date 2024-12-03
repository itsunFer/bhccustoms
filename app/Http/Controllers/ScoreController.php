<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Round;
use App\Models\Score;
use App\Models\Aparato;
use App\Models\Gimnasta;
use App\Models\Competencia;
use App\Models\changeScore;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('scores.allScores');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Competencia $competencia)
    {
        $gimnastas = Gimnasta::all();

        return view('scores.createScore', compact('gimnastas', 'competencia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request['user_id'] = Auth::user()->id;
       $request['approved'] = Auth::user()->is_admin == true ? true : false; //si es administrador la aprobará, de lo contrario la deniega
       $competencia = Competencia::find($request->input('competencias_id'));

        // Determine if 'W' or 'L' corresponds to 0 or 1
        $winloss = strtoupper($request->input('winloss')); // Get win/loss input as 'W' or 'L'
        

        if ($winloss === 'W') {
            // If 'W', set winloss based on the competencia's winner (0 or 1)
            $winlossValue = ($competencia->winners == 1) ? 1 : 0;
        } elseif ($winloss === 'L') {
            // If 'L', set the opposite of the competencia's winner
            $winlossValue = ($competencia->winners == 1) ? 0 : 1;
        } else {
            return redirect()->back()->with('error', 'Invalid win/loss value.');
        }
        
        // Save the score to the database
        $score = new Score([
            'gametag' => $request->input('gametag'),
            'kills' => $request->input('kills'),
            'deaths' => $request->input('deaths'),
            'assists' => $request->input('assists'),
            'acs' => $request->input('acs'),
            'adr' => $request->input('adr'),
            'dd' => $request->input('dd'),
            'hs' => $request->input('hs'),
            'kast' => $request->input('kast'),
            'fk' => $request->input('fk'),
            'fd' => $request->input('fd'),
            'competencias_id' => $request->input('competencias_id'),
            'winloss' => $winlossValue, // Store 0 or 1
            'rank' => $request->input('rank'),
            'plants' => $request->input('plants'),
            'defuses' => $request->input('defuses'),
        ]);
        $score->save();
       return redirect()->route('competencia.show', $request->input('competencias_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        //$this->authorize('update', $score);

        return view('scores.editScore', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        //$this->authorize('update', $score);
        $request->validate([
            'gimnastas_id'=>['required', 'exists:gimnastas,id'], 
            'events_id'=>['required', 'exists:events,id'],
            'rounds_id'=>['required', 'exists:rounds,id'],
            'aparatos_id'=>['required', 'exists:aparatos,id'],
            'difficulty_s'=>['decimal:0,3', 'required', 'min:0', 'max:8'],
            'execution_s'=>['decimal:0,2', 'required', 'min:0', 'max:10'],
            'deductions_s'=>['decimal:0,2', 'required', 'min:0', 'max:10'],  
        ]);
        $request['user_id'] = Auth::user()->id;
        $request['total_s'] = $request->difficulty_s + $request->execution_s - $request->deductions_s;
        $request['edited'] = Auth::user()->is_admin == true ? false : true;

        //dd($request);
        if(Auth::user()->is_admin == true){
            Score::where('id', $score->id)->update($request->except('_token', '_method'));
        }
        else{
            $nScore=Score::create($request->all());
            $change = changeScore::create([
                'old_id' => $score->id,
                'new_id' => $nScore->id,
            ]);
        }

        return redirect()->route('event.show', $request->events_id)->with('score', 'editada');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        $this->authorize('delete', $score);
        $event=$score->events_id;
        $score->delete();
        return redirect()->route('event.show', $event);
    }

    /**
     * Creates the PDF file with scores
     */
    public function createpdf(Event $event){
        $scoresQ= Score::query()
        ->with(['gimnastas', 'events', 'rounds', 'aparatos'])
        ->where('events_id', $event->id)
        ->where('rounds_id', 1)
        ->where('edited', false)
        ->where('approved', true)
        ->orderBy('aparatos_id')
        ->orderBy('total_s', 'desc')
        ->orderBy('execution_s', 'desc')
        ->orderBy('difficulty_s', 'desc')
        ->get();

        $scoresT= Score::query()
        ->with(['gimnastas', 'events', 'rounds', 'aparatos'])
        ->where('events_id', $event->id)
        ->where('rounds_id', 2)
        ->where('edited', false)
        ->where('approved', true)
        ->orderBy('aparatos_id')
        ->orderBy('total_s', 'desc')
        ->orderBy('execution_s', 'desc')
        ->orderBy('difficulty_s', 'desc')
        ->get();

        $scoresA= Score::query()
        ->with(['gimnastas', 'events', 'rounds', 'aparatos'])
        ->where('events_id', $event->id)
        ->where('rounds_id', 3)
        ->where('edited', false)
        ->where('approved', true)
        ->orderBy('aparatos_id')
        ->orderBy('total_s', 'desc')
        ->orderBy('execution_s', 'desc')
        ->orderBy('difficulty_s', 'desc')
        ->get();

        $scoresE= Score::query()
        ->with(['gimnastas', 'events', 'rounds', 'aparatos'])
        ->where('events_id', $event->id)
        ->where('rounds_id', 4)
        ->where('edited', false)
        ->where('approved', true)
        ->orderBy('aparatos_id')
        ->orderBy('total_s', 'desc')
        ->orderBy('execution_s', 'desc')
        ->orderBy('difficulty_s', 'desc')
        ->get();

        //$pdf = Pdf::loadView('scores.scorepdf', compact('scoresQ'));
        //return $pdf->stream()->setOptions(['defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('scores.scorepdf', compact('scoresQ', 'scoresT', 'scoresA', 'scoresE', 'event'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }

    public function aproveI(Score $score) //aprobar
    {
        $this->authorize('approve', $score);
        if($score->approved==0 && $score->edited != true){
            Score::where('id', $score->id)->update(['approved' => true]);
        }

        return redirect()->route('event.controlI', $score->events_id);
    }

    public function denyI(Score $score) //aprobar
    {
        $this->authorize('approve', $score);
        $ret = $score->events_id;
        if($score->approved==0){
            $score->forceDelete();
        }

        return redirect()->route('event.controlI', $ret);
    }
}
