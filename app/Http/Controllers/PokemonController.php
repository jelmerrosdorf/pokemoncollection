<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use App\Models\User;

class PokemonController extends Controller

{
    public function index(Request $request)
    {
        $pokemons = Pokemon::where([
            ['name', '!=', Null],
            ['type', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                    $query->orWhere('type', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy("id", "asc")
            ->paginate(10);

        return view('pokemons.index', compact('pokemons'));
    }

    public function show($id)
    {
        $pokemons = Pokemon::find($id);
        return view('pokemons.show')->with('pokemon', $pokemons);
    }

    public function create()
    {
        $this->authorize('pokemons_create');

        return view('pokemons.create');
    }

    public function store(Request $request)
    {
        $this->authorize('pokemons_create');

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
        $this->authorize('pokemons_edit');

        return view('pokemons.edit',compact('pokemon'));
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $this->authorize('pokemons_edit');

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
        $this->authorize('pokemons_delete');

        $pokemon->delete();

        return redirect()->route('pokemons.index')
            ->with('success','Pokemon released successfully');
    }

    public function caught(Request $request, Pokemon $pokemon){
        $user = User::find(auth()->id());
        $pokemon = Pokemon::find($request->input('id'));
        $pokemon->save();
        $pokemon->user()->attach($user);
        return redirect()->back()->with('status', 'Pokemon has been caught!');
    }

    public function lost(Request $request, Pokemon $pokemon){
        $user = User::find(auth()->id());
        $pokemon = Pokemon::find($request->input('id'));
        $pokemon->save();
        $pokemon->user()->detach($user);
        return redirect()->back()->with('status', 'Pokemon was lost...');
    }

    public function updateStatus(Request $request)
    {
        $this->authorize('pokemons_status');

        $pokemon = Pokemon::findOrFail($request->pokemon_id);
        $pokemon->status = $request->status;
        $pokemon->save();

        return response()->json(['Status changed successfully!']);
    }
}
