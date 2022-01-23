@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center" style="margin-top: 50px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pokemon') }}</div>
                <div class="card-body">
                        <div>
                           <a href="pokemons">Go to Pokemon page!</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center" style="margin-top: 50px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                <div class="card-body">
                    <div>
                        <a href="{{ url('profile') }}">
                            <p>Go to your profile!</p>
                        </a>
                    </div>
                    @if (Session::has('statusMessage'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('statusMessage') }}
                        </div>
                    @elseif (Session::has('flashMessage'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('flashMessage') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
