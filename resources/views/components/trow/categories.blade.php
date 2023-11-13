<tr>
    <td>{{$entry->title}}</td>
    <td>
        @foreach($entry->users as $user)
            {{$user['username']}}
            <br>
        @endforeach
    </td>
    <td>{{$entry->color}}</td>
    <td>
        <a href="{{route('category.edit', ['category' => $entry])}}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>

        <form method="POST" onsubmit="return confirm('Are you sure you want to remove yourself from this category? That will delete all of your associated notes.');" action="{{route('category.destroy', ['category' => $entry])}}">
            @csrf
            @method('DELETE')
            <button class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-800 dark:hover:bg-white focus:bg-red-800 dark:focus:bg-white active:bg-red-700 dark:active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2 dark:focus:ring-offset-red-700 transition ease-in-out duration-150">Delete</button>
        </form>
    </td>
</tr>
