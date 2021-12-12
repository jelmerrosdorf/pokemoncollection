<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller

{
    public function index()
    {
        $pokemons = Pokemon::all();
        return view('pokemons.index', compact('pokemons'));
    }

    public function create()
    {
        return view('pokemons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'type' => 'required'
        ]);

        $pokemon = new Pokemon;
        $pokemon->name = $request->input('name');
        $pokemon->image = $request->file('image')->storePublicly('images', 'public');
        $pokemon->image = str_replace('images/', '', $pokemon->image);
        $pokemon->type = $request->input('type');

        $pokemon->save();

        return redirect()->route('pokemons.index')
            ->with('success','Pokemon added successfully.');
    }

    public function edit(Pokemon $pokemon)
    {
        return view('pokemons.edit',compact('pokemon'));
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $pokemon = Pokemon::find($pokemon->id);
        if (!$request->file('image') == ""){
            $pokemon->image = $request->file('image')->storePublicly('images', 'public');
            $pokemon->image = str_replace('images/', '', $pokemon->image);
        }

        if (!$request->input('name') == ""){
            $pokemon->name = $request->input('name');
        }

        if (!$request->input('type') == ""){
            $pokemon->type = $request->input('type');
        }

        $pokemon->save();

        return redirect()->route('pokemons.index')
            ->with('success','Pokemon updated successfully');
    }

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();

        return redirect()->route('pokemons.index')
            ->with('success','Pokemon released successfully');
    }
}
