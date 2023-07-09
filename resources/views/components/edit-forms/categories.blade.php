<div class="container">
    <h1 class="mt-4"> Enter information about a category </h1> <br>

    <form action="/categories" method="POST">
        @csrf
        @if($editing)
            @method('PUT')
            @php
                echo ('<input type="hidden" id="id" name="id" value="' . $entry->id .'">');
                $checkedEntries = $entry->users;
            @endphp
        @else
            @php
                $checkedEntries = [];
            @endphp
        @endif

        <div class="mb-3">
            <label> Choose users by checking the box in front of their name: </label> <br>
            <x-checkbox name="users" property="username" :entries="App\Models\User::all()" :checkedEntries="$checkedEntries" />
            @error('users')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label"> Title (Between 3 and 50 characters) </label>
            <input type="text" class="form-control" name="title" value="{{($editing ? $entry->title : old('title'))}}">
            @error('username')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="color" class="form-label"> Color </label>
            <input type="color" class="form-control" name="color" value="{{($editing ? $entry->color : old('color'))}}">
            @error('username')
            <p>{{$message}}</p>
            @enderror
        </div>

        <input type="submit" text="Save category" class="btn btn-primary">
        <button type="button" class="btn btn-secondary" onclick="location.href='/categories';">Go Back</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='/';">Home</button>
    </form>
</div>
