<div class="container">
    <form action="/update/category" method="POST">
        <h1 class="mt-4"> Enter information about a category </h1> <br>

        <div class="mb-3">
            <label for="title" class="form-label"> Title (Between 3 and 50 characters) </label>
            <input type="text" class="form-control" name="title" value="{{old('title')}}">
        </div>

        <div class="mb-3">
            <label for="color" class="form-label"> Color </label>
            <input type="color" class="form-control" name="color" value="{{old('color')}}">
        </div>

        <input type="hidden" name="id" value="{{old('id')}}">

        <input type="submit" text="Save category" class="btn btn-primary">
        <button type="button" class="btn btn-secondary" onclick="location.href='/display/category';">Go Back</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='/';">Home</button>
    </form>
</div>
