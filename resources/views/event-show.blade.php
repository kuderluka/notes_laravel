@extends('layout')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    Added by user: <b>{{$event['user']['name']}}</b>
                </div>
                <hr>

                <b>Name:</b> {{ $event['name'] }} <br>

                <b>Address:</b> {{ $event['address']  }}<br>

                <b>Date:</b> {{ $event['date'] }} <br>

                <b>Time:</b> {{ $event['time'] }} <br>

                <b>Description:</b> {{ $event['description'] }} <br>

                <b>Ticket price:</b> {{ $event['ticketPrice'] }}€<br>

                <b>Musician:</b> {{$event['musicians'][0]['name']}}<br>

                @if(isset($event['participants'][0]))
                    <b>Users that are going to this event: </b><br>
                    <ul>
                        @foreach($event['participants'] as $participant)
                            <li>
                                {{ $participant['name'] }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <b>No users are attending this event.</b>
                @endif
                <form action="{{route('event.addAttendee', ['event_id' => $event['id']])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="submit" value="Attend" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                </form>
            </div>
        </div>
    </div>
@endsection

