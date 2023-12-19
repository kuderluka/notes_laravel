@if(in_array($user->email, array_column($event['participants'], 'email')))
    <form action="{{route('event.removeAttendee', ['event_id' => $event['id']])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="submit" value="Revoke Attendance" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
    </form>
@else
    <form action="{{route('event.addAttendee', ['event_id' => $event['id']])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="submit" value="Attend" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
    </form>
@endif


