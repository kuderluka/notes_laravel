@extends('layout')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                @if($heading != 'users')
                    <x-search :type="$heading" :path="'public.data'" />
                @endif

                @if(count($entries) == 0)
                    <p>No {{$heading}} found!</p>
                @else
                    <table class="table">
                        <x-dynamic-component :component="'thead.' . $heading" :public="$public"/>
                        <tbody>
                        @foreach($entries as $entry)
                            <x-dynamic-component :component="'trow.' . $heading" :entry="$entry" :editable="FALSE" :public="$public"/>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                {{$entries->links()}}
            </div>
        </div>
    </div>

@endsection

