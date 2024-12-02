<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Picture;
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
        $gimnastas = Gimnasta::with('paises')
        ->orderBy("paises_id")
        ->paginate(10); //Using 'with' we are implementing eager loading
        return view('gimnastas.indexGimnasta', compact('gimnastas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Gimnasta::class);
        $paises = Pais::orderBy('nombre_p')->get();
        return view('gimnastas.createGimnasta', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Gimnasta::class);
        $request->validate([
            'nombre_g' => ['required', 'max:255'],
            'apellido_g' => ['required', 'max:255'],
            'fecha_n_g'=> ['required', 'date'],
            'paises_id'=>['required', 'exists:paises,id'],
        ]);
        Gimnasta::create($request->all()); 

        $action = "añadido";
        $nombreGimnasta = $request->nombre_g . " " . $request->apellido_g;

        return redirect('gimnasta')->with('gimnasta', 'agregada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gimnasta $gimnasta)
    {
        $imagen = Picture::where('gimnastas_id', '=', $gimnasta->id)
        ->where('approved', true)
        ->get(); //Searches up for the pictures of the gymnast
        $paises= Pais::find($gimnasta->id);
        
        return view('gimnastas.show-gimnasta', compact('gimnasta', 'paises', 'imagen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gimnasta $gimnasta)
    {
        $this->authorize('create', $gimnasta);
        $paises = Pais::orderBy('nombre_p')->get();
        return view('gimnastas.edit-gimnasta', compact('gimnasta', 'paises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gimnasta $gimnasta)
    {
        $this->authorize('create', $gimnasta);
        $request->validate([
            'nombre_g' => ['required', 'max:255'],
            'apellido_g' => ['required', 'max:255'],
            'fecha_n_g'=> ['required', 'date'],
            'paises_id'=>['required', 'exists:paises,id'],
        ]);
        
        Gimnasta::where('id', $gimnasta->id)->update($request->except('_token', '_method')); /*Searchs up for the gymnast and updates it with the request exceptuating the token and method*/
        $nombreGimnasta = $gimnasta->nombre_g . " " . $gimnasta->apellido_g;
        $action = "editado";

        return redirect()->route('gimnasta.show', $gimnasta)->with('gimnasta', 'editada');
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
        $nombreGimnasta = $gimnasta->nombre_g . " " . $gimnasta->apellido_g;
        $action = "eliminado";
        $gimnasta->delete();
        return redirect()->route('gimnasta.index')->with('gimnasta', 'eliminada');
    }

    /**
     * Show the gallery with all pictures from a gymnast
     */
    public function galeria(Gimnasta $gimnasta)
    {
        $pics = Picture::where('gimnastas_id', '=', $gimnasta->id)
        ->where('approved', true) //solo imagenes aprobadas
        ->get();
        return view('gimnastas.galeriaGimnasta', compact('gimnasta', 'pics'));
    }

    /**
     * Sends eMail
     */

}
