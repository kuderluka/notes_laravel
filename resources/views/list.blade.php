@extends('layout')

@section('content')
    <h1>{{$heading . ': '}}</h1>

    @if(count($entries) == 0)
        <p>No {{$heading}} found!</p>
    @else

                <table class="table">
                    <x-dynamic-component :component="'thead.' . $heading" />
                    <tbody>
                    @foreach($entries as $entry)
                        <x-dynamic-component :component="$heading" :entry="$entry"/>
                    @endforeach
                    </tbody>
                </table>

    @endif
@endsection
