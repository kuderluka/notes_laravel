<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
    <x-message />
<body>
<div class="container">
    <br>
    <div class="d-flex justify-content-between align-items-center header">
        <h1>notes_laravel</h1>
        <div>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <a href="{{ route('public.data') }}" class="btn btn-primary button">View public notes</a>
                    @auth
                        <a href="{{ route('user.show') }}" class="btn btn-primary button">My work</a>
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary button">Dashboard</a>
                    @else

                        <a href="{{ route('login') }}" class="btn btn-primary button">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary button">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
    <br>

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@stack('scripts')
</body>
</html>
