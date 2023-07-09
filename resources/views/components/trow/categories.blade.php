<tr>
    <td>
        @php
            foreach($entry->users as $user) {
                echo $user['username'];
        @endphp
            <br>
        @php
            }
        @endphp
    </td>
    <td>{{$entry->title}}</td>
    <td>{{$entry->color}}</td>
    <td>
        <a href="/categories/{{$entry->id}}" class="btn btn-primary">Edit</a>

        <form method="POST" action="/categories/{{$entry->id}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
