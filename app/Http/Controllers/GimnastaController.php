<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Gimnasta;
use Illuminate\Http\Request;
use App\Mail\notificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class GimnastaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gimnastas = Gimnasta::all();
        return view('gimnastas.indexGimnasta', compact('gimnastas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Gimnasta::class);
        return view('gimnastas.createGimnasta');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Gimnasta::class);
        $request->validate([
            'nombre_g' => ['required', 'max:255'],
            'gametag' => ['required', 'max:255'],
        ]);
        Gimnasta::create($request->all()); 

        $action = "añadido";
        $nombreGimnasta = $request->nombre_g . " " . $request->gametag;

        return redirect('player')->with('gimnasta', 'agregada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gimnasta $gimnasta)
    {
        $playerStats = \DB::table('scores')
        ->join('competencias', 'scores.competencias_id', '=', 'competencias.id')
        ->where('scores.gametag', $gimnasta->gametag) // Filter by player
        ->select(
            \DB::raw('SUM(kills) as overall_kills'),
            \DB::raw('SUM(deaths) as overall_deaths'),
            \DB::raw('SUM(assists) as overall_assists'),
            \DB::raw('SUM(acs) / COUNT(*) as acs_per_game'),
            \DB::raw('SUM(adr) / COUNT(*) as adr_per_game'),
            \DB::raw('SUM(kills) / SUM(deaths) as kd_ratio'),
            \DB::raw('AVG(hs) as avg_hs'),
            \DB::raw('AVG(kast) as avg_kast'),
            \DB::raw('SUM(fk) / COUNT(*) as fk_per_game'),
            \DB::raw('SUM(fd) / COUNT(*) as fd_per_game'),
            \DB::raw('COUNT(*) as games_played'),
            \DB::raw('SUM(CASE WHEN competencias.winners = scores.winloss THEN 1 ELSE 0 END) as total_wins')
        )
        ->first();

        return view('gimnastas.show-gimnasta', compact('gimnasta', 'playerStats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gimnasta $gimnasta)
    {
        $this->authorize('create', $gimnasta);
        return view('gimnastas.edit-gimnasta', compact('gimnasta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gimnasta $gimnasta)
    {
        $this->authorize('create', $gimnasta);
        $request->validate([
            'nombre_g' => ['required', 'max:255'],
            'gametag' => ['required', 'max:255'],
        ]);
        
        Gimnasta::where('id', $gimnasta->id)->update($request->except('_token', '_method')); /*Searchs up for the gymnast and updates it with the request exceptuating the token and method*/
        $nombreGimnasta = $gimnasta->nombre_g . "'" . $gimnasta->gametag . "'";
        $action = "editado";

        return redirect()->route('player.show', $gimnasta)->with('gimnasta', 'editada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gimnasta $gimnasta)
    {
        $this->authorize('delete', $gimnasta);
        $pics = Picture::where('gimnastas_id', '=', $gimnasta->id)->get();
        foreach($pics as $pic){
            Storage::delete($pic->hash); //elimina todas las imagenes relacionadas a la gimnasta a eliminar
        }
        $nombreGimnasta = $gimnasta->nombre_g . "'" . $gimnasta->gametag . "'";
        $action = "eliminado";
        $gimnasta->delete();
        return redirect()->route('player.index')->with('gimnasta', 'eliminada');
    }

    /**
     * Show the gallery with all pictures from a gymnast
     */
    public function galeria(Gimnasta $gimnasta)
    {
        $pics = Picture::where('gimnastas_id', '=', $gimnasta->id)
        ->where('approved', true) //solo imagenes aprobadas
        ->get();
        return view('players.galeriaGimnasta', compact('gimnasta', 'pics'));
    }

    /**
     * Sends eMail
     */

}
