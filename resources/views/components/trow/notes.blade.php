<tr>
    <td>{{App\Models\User::find($entry->user)->username}}</td>
    <td>{{App\Models\Category::find($entry->category)->title}}</td>
    <td>{{$entry->title}}</td>
    <td>{{$entry->content}}</td>
    <td>{{$entry->priority}}</td>
    <td>{{$entry->deadline}}</td>
    <td>{{$entry->tags}}</td>
    <td>
        <a href="{{route('notes.destroy', ['note' => $entry])}}" class="btn btn-primary">Edit</a>

        <form method="POST" action="{{route('notes.destroy', ['note' => $entry])}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
