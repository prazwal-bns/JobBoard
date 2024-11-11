<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Job Board</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="from-10% via-30% to-90% mx-auto mt-10 max-w-2xl bg-gradient-to-r from-indigo-100 via-sky-100 to-emerald-100 text-slate-700">

    <nav class="flex justify-between mb-5 text-lg font-medium">
        <ul class="flex space-x-2">
            <li>
                <a href="{{ route('jobs.index') }}">Home</a>
            </li>
        </ul>

        <ul class="flex space-x-2">
            @auth
                {{-- <li>{{ auth()->user()->name ?? 'Anynomuous' }}</li> --}}
                <li>
                    <a href="{{ route('my-job-applications.index') }}">
                        {{ auth()->user()->name ?? 'Anynomus' }}: Applications
                      </a>
                </li>
                <li>
                    <a href="{{ route('my-jobs.index') }}">My Jobs</a>
                </li>
                <li>
                    <form action="{{ route('auth.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Logout</button>
                    </form>
                </li>

            @else
                <li>
                    <a href="{{ route('auth.create') }}">Sign In</a>
                </li>
            @endauth
        </ul>
    </nav>

    @if(session('success'))
        <div role="alert" class="p-4 my-8 text-green-700 bg-green-100 border-green-300 rounded-md opacity-75 border-1-4">
            <p class="font-bold">Success !!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
    <div role="alert" class="p-4 my-8 text-red-700 bg-red-100 border-red-300 rounded-md opacity-75 border-1-4">
        <p class="font-bold">Error !!</p>
        <p>{{ session('error') }}</p>
    </div>
@endif

    {{ $slot }}
</body>
</html>
