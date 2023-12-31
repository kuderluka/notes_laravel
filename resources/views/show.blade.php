@extends('layout')
@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between items-center header">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{$user->username}}'s page
                    </h2>

                    <div class="flex items-end space-x-1">
                        <a href="{{route('category.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">New category</a>
                        <a href="{{route('note.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">New note</a>
                        <a href="{{route('index')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Go back</a>
                    </div>
                </div>

                <div class="container">
                    <h5>Your notes:</h5>
                    @if(count($notes) == 0)
                        <p> &nbsp &nbsp &nbsp You don't have any notes</p>
                    @else
                        <table class="table">
                            <x-dynamic-component :component="'thead.notes'" :public="$public"/>
                            <tbody>
                                @foreach($notes as $note)
                                    <x-dynamic-component :component="'trow.notes'" :entry="$note" :editable="TRUE" :public="$public"/>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $notes->links() }}
                    @endif

                    <br>

                    <h5>Your categories:</h5>
                    @if(count($categories) == 0)
                        <p> &nbsp &nbsp &nbsp You don't have any categories</p>
                    @else
                        <table class="table">
                            <x-dynamic-component :component="'thead.categories'" />
                            <tbody>
                                @foreach($categories as $category)
                                    <x-dynamic-component :component="'trow.categories'" :entry="$category"/>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $categories->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
