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
            <a href="{{route('note.edit', ['note' => $entry])}}" class="btn btn-secondary">Edit</a>

            <form method="POST" onsubmit="return confirm('Are you sure?');" action="{{route('note.destroy', ['note' => $entry])}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </td>
    @endif
</tr>
