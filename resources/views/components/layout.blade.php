<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="/css/app.css" />
    <title>Portal</title>
</head>
<body class="mb-48">
    <nav class="flex justify-between items-center mb-4 px-10 bg-gray-400">
        <div>
            <a href="/"
                ><img class="w-24" src="{{asset('images/portal-logo.png')}}" alt="logo"
            /></a>
            <a href="{{route('news.categories')}}">Categories</a>
        </div>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
            <li>
                <span class="font-bold uppercase">
                    Welcome {{auth()->user()->name}}
                </span>
            </li>
            <li>
                <a href="/news/manage" class="hover:text-laravel"
                    ><i class="fa-solid fa-gear"></i>
                    Manage news</a
                >
            </li>
            <li>
                <form class="inline" method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit">
                    <i class="fa-solid fa-door fa-door-closed"></i> Logout 
                </button>
                </form>
            </li>
            @else
            <li>
                <a href="/register" class="hover:text-laravel"
                    ><i class="fa-solid fa-user-plus"></i> Register</a
                >
            </li>
            <li>
                <a href="/login" class="hover:text-laravel"
                    ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login</a
                >
            </li>
            @endauth
        </ul>
    </nav>

    <main>{{$slot}}</main>

    <footer class="fixed bottom-0 left-0 w-full bg-gray-400 flex items-center justify-start font-bold text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2024, All Rights reserved</p>
        <a
            href="/news/create"
            class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
            >Post news</a
            >
    </footer>

    {{-- message has position: fixed so it does not matter where it is in layout.blade.php --}}
    <x-message />
</body>
</html>