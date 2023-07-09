@extends('layout')

@section('content')
    <x-dynamic-component :component="'edit-forms.' . $heading" :entry="$entry"/>
@endsection
