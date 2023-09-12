@extends('layout')

@section('content')
    <div>
        <br>
        @auth
            <h3 class="text-center">You are logged in!</h3>
        @endauth
        @guest
            <h3 class="text-center">Please log in to manage your profile</h3>
        @endguest
    </div>
@endsection
