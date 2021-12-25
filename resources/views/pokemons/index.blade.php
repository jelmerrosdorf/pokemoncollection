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

            <div>
                <div class="mx-auto float-right">
                    <div class="">
                        <form action="{{ route('pokemons.index') }}" method="GET" role="search">
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="submit">Search</button>
                                        <span class="fas fa-search"></span>
                            </span>
                                <input type="text" class="form-control mr-2" name="term" placeholder="Name or Type" id="term">
                                <a href="{{ route('pokemons.index') }}" class="mt-1"></a>
                            </div>
                        </form>
                    </div>
                </div>
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
                        <a class="btn btn-info" href="{{ route('pokemons.show', $pokemon) }}">Show</a>
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

