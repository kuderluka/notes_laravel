<tr>
    <td>{{$entry->user->username}}</td>
    <td>{{$entry->category->title}}</td>
    <td>{{$entry->title}}</td>
    <td>{{$entry->content}}</td>
    <td>{{$entry->priority}}</td>
    <td>{{$entry->deadline}}</td>
    <td>{{$entry->tags}}</td>
    @if($public)
        <td>
            @if ($entry->public == 1)
                Yes
            @else
                No
            @endif
        </td>
    @endif
    @if($editable)
        <td>
            <a href="{{route('note.edit', ['note' => $entry])}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>

            <form method="POST" onsubmit="return confirm('Are you sure?');" action="{{route('note.destroy', ['note' => $entry])}}">
                @csrf
                @method('DELETE')
                <button class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-800 dark:hover:bg-white focus:bg-red-800 dark:focus:bg-white active:bg-red-700 dark:active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2 dark:focus:ring-offset-red-700 transition ease-in-out duration-150">Delete</button>
            </form>
        </td>
    @endif
</tr>
