<div class="container">
    <h1 class="mt-4"> Enter information about a user </h1>

    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($entry != NULL)
            @method('PUT')
            @php
                $editing = TRUE;
                echo ('<input type="hidden" id="id" name="id" value="' . $entry->id .'">');
                echo ('<input type="hidden" id="oldImage" name="oldImage" value="' . $entry->image .'">')
            @endphp
        @else
            @php
                $editing = FALSE;
            @endphp
        @endif

        <div class="mb-3">
            <label for="username" class="form-label"> Name (Between 5 and 20 numbers or letters) </label>
            <input type="text" class="form-control" id="username" name="username" value="{{($editing ? $entry->username : old('username'))}}">
            @error('username')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label"> Password (More than 5 characters) </label>
            <input type="password" class="form-control" id="password" name="password" value="{{($editing ? $entry->password : old('password'))}}">
            @error('password')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"> E-mail (Must be a valid email) </label>
            <input type="email" class="form-control" id="email" name="email" value="{{($editing ? $entry->email : old('email'))}}">
            @error('email')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label"> Select your profile picture </label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="{{$editing ? asset('storage/' . $entry->image) : ''}}" height="200">
            @error('image')
            <p>{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save User</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='{{route('users.index')}}';">Go Back</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='{{route('/')}}';">Home</button>
    </form>
</div>
