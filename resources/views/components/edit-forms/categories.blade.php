<div class="container">
    <h1 class="mt-4"> Enter information about a category </h1> <br>

    <form action="{{route('categories.store')}}" method="POST">
        @csrf
        @if($entry != NULL)
            @method('PUT')
            @php
                echo ('<input type="hidden" id="id" name="id" value="' . $entry->id .'">');
            @endphp
        @endif

        <div class="mb-3">
            <label> Choose users by checking the box in front of their name: </label> <br>
            <x-checkbox name="users" property="username" :entries="App\Models\User::all()" :checkedEntries="$entry?->users" />
            @error('users')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label"> Title (Between 3 and 50 characters) </label>
            <input type="text" class="form-control" name="title" value="{{old('title', $entry?->title)}}">
            @error('username')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="color" class="form-label"> Color </label>
            <input type="color" class="form-control" name="color" value="{{old('color', $entry?->color)}}">
            @error('username')
            <p>{{$message}}</p>
            @enderror
        </div>

        <input type="submit" text="Save category" class="btn btn-primary">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Go Back</a>
        <a href="{{ route('/') }}" class="btn btn-secondary">Home</a>
    </form>
</div>
