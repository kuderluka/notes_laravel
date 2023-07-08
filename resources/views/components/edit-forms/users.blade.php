<div class="container">
    <form action="/users" method="POST" enctype="multipart/form-data">
        @csrf
        <h1 class="mt-4"> Enter information about a user </h1>

        <input type="hidden" id="id" name="id" value="">

        <div class="mb-3">
            <label for="username" class="form-label"> Name (Between 5 and 20 numbers or letters) </label>
            <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
            @error('username')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label"> Password (More than 5 characters) </label>
            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
            @error('password')
            <p>{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"> E-mail (Must be a valid email) </label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
            @error('email')
            <p>{{$message}}</p>
            @enderror
        </div>

        <!--
        <div class="mb-3">
            <label for="image" class="form-label"> Select your profile picture </label>
            <input type="file" class="form-control-file" id="image" name="image">
            @error('file')
            <p>{{$message}}</p>
            @enderror
        </div>
        -->
        <button type="submit" class="btn btn-primary">Save User</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='/users';">Go Back</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='/';">Home</button>
    </form>
</div>
