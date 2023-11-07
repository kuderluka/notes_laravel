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
        <a href="{{route('category.edit', ['category' => $entry])}}" class="btn btn-secondary">Edit</a>

        <form method="POST" onsubmit="return confirm('Are you sure you want to remove yourself from this category? That will delete all of your associated notes.');" action="{{route('category.destroy', ['category' => $entry])}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
