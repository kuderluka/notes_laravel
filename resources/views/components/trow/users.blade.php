<tr>
    <td>{{$entry->username}}</td>
    <td>{{$entry->email}}</td>
    <td>{{$entry->password}}</td>
    <td>{{$entry->image}}</td>
    <td>
        <a href="/users/{{$entry->id}}" class="btn btn-primary">Edit</a>

        <form method="POST" action="/users/{{$entry->id}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>