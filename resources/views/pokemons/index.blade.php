@extends('layouts.app')

@section('head')
    {{--    Ajax loading in --}}
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    {{--    Cloudflare Toggle   --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">
                <h2>Pokemon, gotta catch 'em all!</h2>
            </div>

            <br>

            <div class="pull-right">
                @can('pokemons_create')
                <a class="btn btn-success" href="{{ route('pokemons.create') }}"> Add new Pokemon</a>
                @endcan
            </div>

            <br>

            <div>
                <div class="mx-auto float-right">
                    <div class="">
                        <form action="{{ route('pokemons.index') }}" method="GET" role="search">
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="submit">Search</button>
                            </span>
                                <input type="text" style="width: 33.3%" name="search" placeholder="Name or Type" id="search">
                                <a href="{{ route('pokemons.index') }}" class="mt-1"></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <br>

        </div>

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif($message = Session::get('failure'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Type</th>
            <th>Caught</th>
            <th>Obtainable</th>
            <th>Action</th>
        </tr>
        @foreach ($pokemons as $pokemon)
            <tr>
                <td>{{ $pokemon->name }}</td>
                <td style="width: 25%"><img src="{{ asset("storage/images/".$pokemon['image']) }}" alt="{{ $pokemon->name }}" height="250px" width="250px"></td>
                <td>{{ $pokemon->type }}</td>
                <td>
                    <div>
                        @if($pokemon->user()->find(Auth::id()))
                            <form action="{{ route('lost', $pokemon)  }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <div>
                                        <input type="id" id="id" name="id" value="{{$pokemon->id}}" hidden>
                                        <button type="submit" class="btn btn-outline-warning">Caught!</button>
                                    </div>
                                </div>
                            </form>
                        @elseif($pokemon->user()->find(Auth::id()) === null)
                            <form action="{{ route('caught', $pokemon)  }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="id" id="id" name="id" value="{{$pokemon->id}}" hidden>
                                <button type="submit" class="btn btn-outline-success">Not yet!</button>
                            </form>
                        @endif
                    </div>
                </td>
                <td>
                    <input type="checkbox" data-id="{{ $pokemon->id }}" name="status"
                           class="js-switch" {{ $pokemon->status == 1 ? 'checked' : '' }}>
                </td>
                <td>
                    <form action="{{ route('pokemons.destroy',$pokemon) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('pokemons.show', $pokemon) }}">Show</a>

                        @can('pokemons_edit')
                        <a class="btn btn-primary" href="{{ route('pokemons.edit',$pokemon) }}">Edit</a>
                        @endcan

                        @csrf
                        @method('DELETE')
                        @can('pokemons_delete')
                        <button type="submit" class="btn btn-danger">Release</button>
                        @endcan
                    </form>

                </td>
            </tr>
        @endforeach
    </table>

@endsection

@section('script')
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function(html) {
            let newSlider = new Switchery(html,  { size: 'small' });
        });
    </script>
    <script src="{{asset("js/slider.js")}}"></script>
@endsection

