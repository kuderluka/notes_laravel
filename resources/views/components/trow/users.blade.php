<tr>
    <td>{{$entry->username}}</td>
    <td>{{$entry->email}}</td>
    <td>{{$entry->password}}</td>
    <td> <img src="{{asset('storage/' . $entry->image)}}" height="100"></td>
    <td>
        <a href="{{route('users.edit', ['user' => $entry])}}" class="btn btn-primary">Edit</a>

        <form method="POST" onsubmit="return confirm('Are you sure?');" action="{{route('users.destroy', ['user' => $entry])}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
