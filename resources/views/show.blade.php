@extends('layout')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center header">
        <h4>{{$entry->username}}'s page</h4>
        <div>
            <a href="{{route('users.create')}}" class="btn btn-primary button">Create new</a>
            <a href="{{route('index')}}" class="btn btn-primary button">Go back</a>
        </div>
    </div>

    <div class="container">
        <h5>Your notes:</h5>
            @if(count($entry->notes) != 0)
                @foreach($entry->notes as $note)
                    &emsp;{{$note['title']}} <br>
                @endforeach
            @else
                <p>&emsp;This user has no notes</p>
            @endif

        <h5>Your categories:</h5>
            @if(count($entry->categories) != 0)
                @foreach($entry->categories as $category)
                    &emsp;{{$category['title']}} <br>
                @endforeach
            @else
                <p>&emsp;This user has no categories</p>
            @endif
    </div>
</div>

@endsection
