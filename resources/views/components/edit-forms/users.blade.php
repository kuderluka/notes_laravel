<div class="container">
    <form action="/users/" method="POST" enctype="multipart/form-data">
        <h1 class="mt-4"> Enter information about a user </h1>

        <div class="mb-3">
            <label for="name" class="form-label"> Name (Between 5 and 20 numbers or letters) </label>
            <input type="text" class="form-control" id="name" name="name" value="">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"> E-mail (Must be a valid email containing @ and .smth) </label>
            <input type="email" class="form-control" id="email" name="email" value="">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label"> Password (More than 5 characters) </label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label"> Select your profile picture </label>
            <input type="file" class="form-control-file" id="file" name="file">
        </div>

        <button type="submit" class="btn btn-primary">Save User</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='/users';">Go Back</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='/';">Home</button>
    </form>
</div>
