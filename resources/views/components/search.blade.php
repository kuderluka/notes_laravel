<form action="{{ route('public.data') }}" method="GET">
    <div>
        <input type="text" name="search" placeholder="Enter the series of characters you want to search for here" value="{{ request('search') }}">
        <button type="submit"> Search </button>
    </div>
</form>

