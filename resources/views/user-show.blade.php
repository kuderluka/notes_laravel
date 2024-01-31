@extends('layout')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between items-center header">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{$user->username}}'s page
                    </h2>
                </div>

                <br>

                <div class="container">
                    <h5>{{$user->username}}'s notes:</h5>
                    @if(count($notes) == 0)
                        <p> &nbsp &nbsp &nbsp This user doesn't have any notes</p>
                    @else
                        <table class="table">
                            <x-dynamic-component :component="'thead.notes'" :public="false"/>
                            <tbody>
                            @foreach($notes as $note)
                                <x-dynamic-component :component="'trow.notes'" :entry="$note" :editable="false" :public="false"/>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $notes->links() }}
                    @endif
                </div>

                <div class="container">
                    <h5>{{$user->username}}'s events:</h5>

                    @if(count($events) == 0)
                        <p> &nbsp &nbsp &nbsp This user isn't participating in any events! </p>
                    @else
                        <table class="table">
                            <tbody>
                            @foreach($events as $event)
                                <x-trow.event :event="$event"/>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $notes->links() }}
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
