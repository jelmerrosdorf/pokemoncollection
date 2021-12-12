@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">
                <h2>Pokemon, gotta catch 'em all!</h2>
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
        </tr>
        @foreach ($pokemons as $pokemon)
            <tr>
                <td>{{ $pokemon->name }}</td>
                <td><img src="{{ asset("storage/images/".$pokemon['image']) }}" alt="{{ $pokemon->name }}" height="250px" width="250px"></td>
                <td>{{ $pokemon->type }}</td>
            </tr>
        @endforeach
    </table>

@endsection

