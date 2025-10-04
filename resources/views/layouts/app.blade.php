<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Magic Moments') }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">

  {{-- Elegant Navbar --}}
  <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur supports-[backdrop-filter]:bg-white/70 border-b">
    <div class="max-w-6xl mx-auto px-4">
      <div class="h-16 flex items-center justify-between gap-4">

        <div class="flex items-center gap-6">
          <a href="{{ route('home') }}" class="shrink-0" aria-label="Magic Moments — Home">
            <img src="{{ asset('images/logo.png') }}" alt="Magic Moments" class="h-9 w-auto">
          </a>

          <div class="hidden md:flex items-center gap-4">
            <a href="{{ route('menus') }}" class="text-sm {{ request()->routeIs('menus') ? 'text-indigo-700 font-medium' : 'text-gray-700 hover:text-indigo-700' }}">Food</a>
            <a href="{{ route('decor') }}" class="text-sm {{ request()->routeIs('decor') ? 'text-indigo-700 font-medium' : 'text-gray-700 hover:text-indigo-700' }}">Decor</a>
            <a href="{{ route('music') }}" class="text-sm {{ request()->routeIs('music') ? 'text-indigo-700 font-medium' : 'text-gray-700 hover:text-indigo-700' }}">Music</a>
          </div>
        </div>

        <div class="hidden md:flex items-center gap-3">
         <a href="{{ route('book.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-600 text-white text-sm font-medium hover:bg-slate-700">
  Book Now
</a>

          @auth
            @if(auth()->user()->role === 'admin')
              <a href="{{ route('admin.dashboard') }}" class="text-sm {{ request()->routeIs('admin.*') ? 'text-indigo-700 font-medium' : 'text-gray-700 hover:text-indigo-700' }}">Dashboard</a>
            @endif
            <form class="inline" method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="text-sm text-gray-700 hover:text-indigo-700">Logout</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-indigo-700">Admin</a>
          @endauth
        </div>

        <details class="relative md:hidden">
          <summary class="list-none inline-flex items-center justify-center h-10 w-10 rounded-lg border hover:bg-gray-50 cursor-pointer" aria-label="Toggle menu">
            <svg viewBox="0 0 24 24" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </summary>
          <div class="absolute right-0 mt-2 w-56 bg-white border rounded-xl shadow-lg p-2">
            <a href="{{ route('menus') }}" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-50 {{ request()->routeIs('menus') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">Food</a>
            <a href="{{ route('decor') }}" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-50 {{ request()->routeIs('decor') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">Decor</a>
            <a href="{{ route('music') }}" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-50 {{ request()->routeIs('music') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">Music</a>
            <div class="my-1 border-t"></div>
            <a href="{{ route('book.create') }}" class="block px-3 py-2 rounded-lg text-sm bg-amber-600 text-white hover:bg-amber-700">Book Now</a>
            @auth
              @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-50 {{ request()->routeIs('admin.*') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">Dashboard</a>
              @endif
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-3 py-2 rounded-lg text-sm hover:bg-gray-50 text-gray-700">Logout</button>
              </form>
            @else
              <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-50 text-gray-700">Admin</a>
            @endauth
          </div>
        </details>

      </div>
    </div>
  </nav>

  <main class="max-w-6xl mx-auto p-6">
    @if (session('success'))
      <div class="mb-4 rounded border border-green-300 bg-green-50 text-green-800 p-3">
        {{ session('success') }}
      </div>
    @endif
    @if ($errors->any())
      <div class="mb-4 rounded border border-red-300 bg-red-50 text-red-800 p-3">
        <div class="font-semibold mb-1">Please fix the following:</div>
        <ul class="list-disc ml-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('content')
  </main>

  <footer class="mt-12 py-6 border-t text-center text-sm text-gray-500">
    © {{ date('Y') }} Magic Moments
  </footer>
</body>
</html>
