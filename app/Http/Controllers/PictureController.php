<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->cannot('viewAny', Picture::class)) {
            abort(404);
        }
        $pictures = Picture::where('approved', true)
        ->get();

        return view('pictures.indexPicture', compact('pictures'));
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
            'picture' => ['image'],
        ]);
        if($request->hasFile('picture') && $request->file('picture')->isValid()){
            $route = $request->picture->store('public');
            $ret = $request->gimnastas_id;
            $pictures = new Picture();
            $pictures->hash = $route;
            $pictures->nombre = $request->picture->getClientOriginalName();
            $pictures->extension = $request->picture->guessExtension();
            $pictures->mime = $request->picture->getMimeType();
            $pictures->gimnastas_id = $request->gimnastas_id;
            $pictures->approved = Auth::user()->is_admin == true ? true : false; //si es administrador la aprobará, de lo contrario la deniega
            $pictures->save();

        }
        return redirect()->route('gimnasta.show', $request->gimnastas_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Picture $picture)
    {
        Storage::delete($picture->hash);
        $picture->delete();
        return redirect()->route('picture.index');
    }

    public function controlP()
    {
        if (Auth::user()->cannot('viewAny', Picture::class)) {
            abort(404);
        }
        $pictures = Picture::where('approved', false)->get();

        return view('pictures.controlPicture', compact('pictures'));
    }

    public function aproveP(Picture $picture) //aprobar
    {
        $this->authorize('approve', $picture);
        if($picture->approved==0){
            Picture::where('id', $picture->id)->update(['approved' => true]);
        }

        return redirect()->route('picture.controlP');
    }

    public function denyP(Picture $picture) //denegar
    {
        $this->authorize('approve', $picture);
        if($picture->approved==0){
            Storage::delete($picture->hash);
            $picture->delete();
        }
        return redirect()->route('picture.controlP');
    }
}
