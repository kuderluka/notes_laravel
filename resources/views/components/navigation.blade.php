<div class="container">
    <br>
    <div class="d-flex justify-content-between align-items-center header">
        <h3>You are currently viewing {{$heading}}</h3>
        <div>
            <a href="{{route($heading . '.create')}}" class="btn btn-primary button">Create new</a>
            <a href="{{route('/')}}" class="btn btn-primary button">Go back</a>
        </div>
    </div>
    <br>
</div>

