@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">
                <h2>Pokemon, gotta catch 'em all!</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('pokemons.create') }}"> Add new Pokemon</a>
            </div>

        </div>

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
        @foreach ($pokemons as $pokemon)
            <tr>
                <td>{{ $pokemon->name }}</td>
                <td><img src="{{ asset("storage/images/".$pokemon['image']) }}" alt="{{ $pokemon->name }}" height="250px" width="250px"></td>
                <td>{{ $pokemon->type }}</td>
                <td>
                    <form action="{{ route('pokemons.destroy',$pokemon) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('pokemons.edit',$pokemon) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Release</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection

