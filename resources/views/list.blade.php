@extends('layout')


@section('content')
    <x-navigation :heading="$heading"></x-navigation>

    @if(count($entries) == 0)
        <p>No {{$heading}} found!</p>
    @else
        <table class="table">
            <x-dynamic-component :component="'thead.' . $heading" />
            <tbody>
            @foreach($entries as $entry)
                <x-dynamic-component :component="'trow.' . $heading" :entry="$entry"/>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
