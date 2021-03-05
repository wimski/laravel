@extends('layouts.auth')

@section('heading')
    {{ __('Dashboard') }}
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <p>{{ __('You are logged in!') }}</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">{{ __('Logout') }}</button>
    </form>
@endsection
