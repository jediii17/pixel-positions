<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel Positions</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white font-hanken-grotesk pb-20">
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/img/logo.svg') }}" alt="">
                </a>
            </div>

           @auth
                @if (auth()->user()->role === 'member')
                    <div class="space-x-6 font-bold">
                        <a href="/">Jobs</a>
                        <a href="#">Careers</a>
                        <a href="#">Salaries</a>
                        <a href="#">Companies</a>
                    </div>
                @endif
           @endauth
            
            @auth
                <div class="space-x-6 font-bold flex items-center relative">

                    {{-- @can('viewAppliedJobs')
                        <a href="/jobs/applied">Applied Job</a>
                    @endcan --}}

                    @if(Auth::check() && Auth::user()->role === 'member')
                        <a href="/jobs/applied">Applied Job</a>
                    @endif


                    @if(auth()->user()->role === 'employer')
                        <a href="/jobs/create">Post a Job</a>
                        <a href="/jobs/view-applicants">View Applicants</a>
                    @endif

                    <div class="relative group">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M12 4a8 8 0 0 0-6.96 11.947A4.99 4.99 0 0 1 9 14h6a4.99 4.99 0 0 1 3.96 1.947A8 8 0 0 0 12 4m7.943 14.076q.188-.245.36-.502A9.96 9.96 0 0 0 22 12c0-5.523-4.477-10-10-10S2 6.477 2 12a9.96 9.96 0 0 0 2.057 6.076l-.005.018l.355.413A9.98 9.98 0 0 0 12 22q.324 0 .644-.02a9.95 9.95 0 0 0 5.031-1.745a10 10 0 0 0 1.918-1.728l.355-.413zM12 6a3 3 0 1 0 0 6a3 3 0 0 0 0-6"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div
                            class="absolute right-0 w-40 bg-gray-800 rounded-md shadow-lg hidden group-hover:block transition duration-300">
                            @if(auth()->user()->role === 'member')
                                <a href="/profile" class="block px-4 py-2 text-white hover:bg-gray-700 rounded-t-md">Member Profile</a>
                            @else
                                <a href="/profile" class="block px-4 py-2 text-white hover:bg-gray-700 rounded-t-md">Employer Profile</a>
                            @endif
                            <form method="POST" action="/logout" class="block">
                                @csrf
                                @method('DELETE')
                                <button class="w-full text-left px-4 py-2 text-white hover:bg-gray-700 rounded-b-md">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            @guest
                <div class="space-x-6 font-bold">
                    <a href="/register">Sign Up</a>
                    <a href="/login">Log In</a>
                </div>
            @endguest
        </nav>

        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>

</body>
</html>