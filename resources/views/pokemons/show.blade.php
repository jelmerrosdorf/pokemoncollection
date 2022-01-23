@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show this Pokemon!</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pokemons.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <br>

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Type</th>
        </tr>

        <tr>
            <td>{{ $pokemon->name }}</td>
            <td style="width: 33.3%"><img src="{{ asset("storage/images/".$pokemon['image']) }}" alt="{{ $pokemon->name }}" height="250px" width="250px"></td>
            <td>{{ $pokemon->type }}</td>
        </tr>

    </table>

@endsection
