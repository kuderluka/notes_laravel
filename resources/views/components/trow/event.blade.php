<article class="p-3 border mt-5 bg-gray-100 shadow sm:rounded-lg">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <b>Name:</b> {{ $event['name'] }}<br>
            <b>Date:</b> {{ $event['date'] }}<br>
            <b>Ticket price:</b> {{ $event['ticketPrice'] }}€ <br>

            @if(!empty($event['musicians']))
                <b>Musician:</b> {{ $event['musicians'][0]['name'] }} <br>
            @else
                <b>Musician:</b> No musician associated <br>
            @endif
        </div>
        <a href="{{route('event.show', ['event' => $event['id']])}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 4transition ease-in-out duration-150">More</a>
    </div>
</article>
