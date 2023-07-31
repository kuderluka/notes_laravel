<div class="container">
    <h1 class="mt-4"> Enter information about a user </h1>

    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($entry != NULL)
            @method('PUT')
            @php
                echo ('<input type="hidden" id="id" name="id" value="' . $entry->id .'">');
                echo ('<input type="hidden" id="oldImage" name="oldImage" value="' . $entry->image .'">');
            @endphp
        @endif

        <div class="mb-3">
            <label for="username" class="form-label"> Name (Between 5 and 20 numbers or letters) </label>
            <input type="text" class="form-control" id="username" name="username" value="{{old('username', $entry?->username)}}">
            @error('username')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label"> Password (More than 5 characters) </label>
            <input type="password" class="form-control" id="password" name="password" value="{{old('password', $entry?->password)}}">
            @error('password')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"> E-mail (Must be a valid email) </label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email', $entry?->email)}}">
            @error('email')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label"> Select your profile picture </label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="{{old('image', asset('storage/' . $entry?->image))}}" height="200">
            @error('image')
            <p>{{$message}}</p>
            @enderror
        </div>

        <x-buttons path="users.index" type="User" ></x-buttons>
    </form>
</div>
