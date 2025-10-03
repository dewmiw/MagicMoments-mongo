<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'Magic Moments') }}</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">
<nav class="bg-white/90 backdrop-blur border-b">
<div class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-4">
<a href="{{ route('home') }}" class="font-semibold">Magic Moments</a>
<a href="{{ route('menus') }}" class="hover:text-indigo-600">Food</a>
<a href="{{ route('decor') }}" class="hover:text-indigo-600">Decor</a>
<a href="{{ route('music') }}" class="hover:text-indigo-600">Music</a>
<a href="{{ route('book.create') }}" class="ml-2 px-3 py-1.5 rounded bg-indigo-600 text-white hover:bg-indigo-700">Book Now</a>
<div class="ml-auto">
@auth
<a href="{{ route('admin.dashboard') }}" class="mr-3 hover:text-indigo-600">Dashboard</a>
<form class="inline" method="POST" action="{{ route('logout') }}">@csrf<button class="hover:text-indigo-600">Logout</button></form>
@else
<a href="{{ route('login') }}" class="hover:text-indigo-600">Admin</a>
@endauth
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