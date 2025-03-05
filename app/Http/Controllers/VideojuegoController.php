<?php

namespace App\Http\Controllers;

use App\Models\Desarrolladora;
use App\Models\Posesion;
use App\Models\Videojuego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('videojuegos.index', 
        [
            'posesiones' => Posesion::where('user_id', Auth::id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videojuegos.create',
            ['desarrolladoras' => Desarrolladora::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'anyo' => 'required|string|max:255',
            'desarrolladora_id' => 'required'
            ]);
            $videojuego = Videojuego::create($request->all());

            $posesion = new Posesion();
            $posesion->user_id = Auth::user()->id;
            $posesion->videojuego_id = $videojuego->id;
            $posesion->save();
            return redirect()->route('videojuegos.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        return view('videojuegos.edit',
        ['desarrolladoras' => Desarrolladora::all(),
        'videojuego' => $videojuego]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
        $request->validate([
            'titulo' => 'required|string',
            'anyo' => 'required|string|max:255',
            'desarrolladora_id' => 'required'
            ]);
        $videojuego->update($request->all());
        return redirect()->route('videojuegos.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        $videojuego->delete();
        return redirect()->route('videojuegos.index');	

    }

    public function poseo() { 
        return view('videojuegos.poseo', [
        'videojuegos' => Videojuego::all(),
        ]);
    }

    public function tengo(Videojuego $videojuego) { 
        if (Posesion::where('user_id', Auth::id())->where('videojuego_id', $videojuego->id)->exists()) {
            return redirect()->route('videojuegos.index')->withErrors(['error' => 'Ya tienes este videojuego.']);
        } else {
            $user = Auth::user();
            $posesion = new Posesion();
            $posesion->user_id = Auth::user()->id;
                $posesion->videojuego_id = $videojuego->id;
                $posesion->save();
            return redirect()->route('videojuegos.index');
        }
    }

    public function notengo(Videojuego $videojuego) { 
        if (!Posesion::where('user_id', Auth::id())->where('videojuego_id', $videojuego->id)->exists()) {
            return redirect()->route('videojuegos.index')->withErrors(['error' => 'No tienes este videojuego.']);
        } else {
            $user = Auth::user();
            $posesion = Posesion::where('user_id', Auth::id())->where('videojuego_id', $videojuego->id);
            $posesion->delete();
            return redirect()->route('videojuegos.index');
        }
    } 
   
}