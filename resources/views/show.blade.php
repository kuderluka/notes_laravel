@extends('layout')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center header">
        <h4>{{$user->username}}'s page</h4>

        <div>
            <a href="{{route('category.create')}}" class="btn btn-primary button">New category</a>
            <a href="{{route('note.create')}}" class="btn btn-primary button">New note</a>
            <a href="{{route('index')}}" class="btn btn-primary button">Go back</a>
        </div>
    </div>

    <div class="container">
        <h5>Your notes:</h5>
            @if(count($user->notes) == 0)
                <p>You don't have any notes</p>
            @else
                <table class="table">
                    <x-dynamic-component :component="'thead.notes'" />
                    <tbody>
                    @foreach($user->notes as $note)
                        <x-dynamic-component :component="'trow.notes'" :entry="$note" :editable="TRUE"/>
                    @endforeach
                    </tbody>
                </table>
            @endif

        <h5>Your categories:</h5>
            @if(count($user->categories) == 0)
                <p>You don't have any categories</p>
            @else
                <table class="table">
                    <x-dynamic-component :component="'thead.categories'" />
                    <tbody>
                    @foreach($user->categories as $category)
                        <x-dynamic-component :component="'trow.categories'" :entry="$category"/>
                    @endforeach
                    </tbody>
                </table>
            @endif
    </div>
</div>

@endsection
