@extends('layouts.app')
@section('content')
{{-- Admin Dashboard — all CRUD inline --}}

{{-- HEADER / STATS --}}
<div class="mb-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Dashboard</h1>
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-800">Refresh</a>
  </div>
  <p class="text-gray-600">Welcome back! Manage your catalog and review incoming bookings here.</p>

  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
    <div class="bg-white rounded-2xl shadow p-4">
      <div class="text-sm text-gray-500">Total Bookings</div>
      <div class="text-2xl font-bold">{{ $stats['totalBookings'] ?? $bookings->count() }}</div>
    </div>
    <div class="bg-white rounded-2xl shadow p-4">
      <div class="text-sm text-gray-500">Food Menus</div>
      <div class="text-2xl font-bold">{{ $menus->count() }}</div>
    </div>
    <div class="bg-white rounded-2xl shadow p-4">
      <div class="text-sm text-gray-500">Decorations</div>
      <div class="text-2xl font-bold">{{ $decorations->count() }}</div>
    </div>
    <div class="bg-white rounded-2xl shadow p-4">
      <div class="text-sm text-gray-500">Music Packages</div>
      <div class="text-2xl font-bold">{{ $music->count() }}</div>
    </div>
  </div>
</div>

{{-- FLASH / ERRORS --}}
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

{{-- QUICK NAV --}}
<nav class="mb-6 text-sm">
  <a href="#bookings" class="mr-4 text-indigo-700 hover:underline">Bookings</a>
  <a href="#food" class="mr-4 text-indigo-700 hover:underline">Food Menus</a>
  <a href="#decor" class="mr-4 text-indigo-700 hover:underline">Decorations</a>
  <a href="#music" class="text-indigo-700 hover:underline">Music</a>
</nav>

{{-- ===================== BOOKINGS ===================== --}}
<section id="bookings" class="mb-10">
  <h2 class="text-xl font-semibold mb-3">Recent Bookings</h2>
  <div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-sm">
      <thead>
        <tr class="text-left border-b bg-gray-50">
          <th class="p-2">When (ID)</th>
          <th class="p-2">Name</th>
          <th class="p-2">Email</th>
          <th class="p-2">Event</th>
          <th class="p-2">Date</th>
          <th class="p-2">Guests</th>
          <th class="p-2">Prefs</th>
          <th class="p-2">Images</th>
        </tr>
      </thead>
      <tbody>
        @forelse($bookings as $b)
          <tr class="border-b align-top">
            <td class="p-2 whitespace-nowrap">{{ optional($b->_id)->__toString() }}</td>
            <td class="p-2">
              <div class="font-medium">{{ $b->name }}</div>
              <div class="text-gray-500 text-xs">{{ $b->phone }}</div>
            </td>
            <td class="p-2">{{ $b->email }}</td>
            <td class="p-2">{{ $b->event_type }}</td>
            <td class="p-2 whitespace-nowrap">{{ optional($b->event_date)->format('Y-m-d') }}</td>
            <td class="p-2">{{ $b->guests }}</td>
            <td class="p-2 text-xs text-gray-700">
              @if($b->food_pref)<div><span class="font-medium">Food:</span> {{ Str::limit($b->food_pref, 80) }}</div>@endif
              @if($b->music_pref)<div><span class="font-medium">Music:</span> {{ Str::limit($b->music_pref, 80) }}</div>@endif
              @if($b->deco_pref)<div><span class="font-medium">Decor:</span> {{ Str::limit($b->deco_pref, 80) }}</div>@endif
              @if($b->notes)<div class="text-gray-500 italic mt-1">“{{ Str::limit($b->notes, 80) }}”</div>@endif
            </td>
            <td class="p-2">
              @if(is_array($b->images) && count($b->images))
                <div class="flex gap-2 flex-wrap">
                  @foreach($b->images as $img)
                    <a href="{{ Storage::url($img) }}" target="_blank" class="block">
                      <img src="{{ Storage::url($img) }}" class="h-12 w-12 object-cover rounded" alt="ref">
                    </a>
                  @endforeach
                </div>
              @endif
            </td>
          </tr>
        @empty
          <tr><td class="p-3 text-gray-500" colspan="8">No bookings yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

{{-- ===================== FOOD MENUS ===================== --}}
<section id="food" class="mb-10">
  <div class="flex items-center justify-between mb-3">
    <h2 class="text-xl font-semibold">Food Menus</h2>
  </div>

  {{-- Create --}}
  <form method="POST" action="{{ route('admin.food-menus.store') }}" class="bg-white rounded-2xl shadow p-4 mb-4">
    @csrf
    <div class="grid md:grid-cols-4 gap-3">
      <input name="name" placeholder="Name" required class="border rounded p-2"/>
      <input name="price_per_person" type="number" step="0.01" min="0" placeholder="Price per person (LKR)" class="border rounded p-2"/>
      <input name="items" placeholder="Items (comma-separated)" class="border rounded p-2"/>
      <input name="description" placeholder="Description" class="border rounded p-2"/>
    </div>
    <div class="mt-3 text-right">
      <button class="bg-indigo-600 text-white px-4 py-2 rounded">Add Menu</button>
    </div>
  </form>

  {{-- List + inline edit --}}
  <div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-sm">
      <thead>
        <tr class="text-left border-b bg-gray-50">
          <th class="p-2">Name</th>
          <th class="p-2">Price/Person</th>
          <th class="p-2">Items</th>
          <th class="p-2">Description</th>
          <th class="p-2 text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($menus as $it)
          <tr class="border-b align-top">
            <td class="p-2 w-48">{{ $it->name }}</td>
            <td class="p-2 w-32">{{ isset($it->price_per_person) ? 'LKR '.number_format((float)$it->price_per_person,2) : '-' }}</td>
            <td class="p-2">@if(is_array($it->items)) {{ implode(', ', $it->items) }} @endif</td>
            <td class="p-2">{{ $it->description }}</td>
            <td class="p-2 text-right w-64">
              <details class="inline-block mr-2">
                <summary class="cursor-pointer px-3 py-1 rounded border">Edit</summary>
                <form method="POST" action="{{ route('admin.food-menus.update', $it->_id) }}" class="mt-2 space-y-2">
                  @csrf @method('PUT')
                  <input name="name" value="{{ $it->name }}" class="border rounded p-2 w-full"/>
                  <input name="price_per_person" value="{{ $it->price_per_person }}" type="number" step="0.01" min="0" class="border rounded p-2 w-full"/>
                  <input name="items" value="{{ is_array($it->items) ? implode(', ', $it->items) : '' }}" class="border rounded p-2 w-full"/>
                  <input name="description" value="{{ $it->description }}" class="border rounded p-2 w-full"/>
                  <div class="text-right">
                    <button class="bg-indigo-600 text-white px-3 py-1 rounded">Save</button>
                  </div>
                </form>
              </details>
              <form action="{{ route('admin.food-menus.destroy', $it->_id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this menu?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 rounded border border-red-300 text-red-700">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td class="p-3 text-gray-500" colspan="5">No menus yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

{{-- ===================== DECORATIONS ===================== --}}
<section id="decor" class="mb-10">
  <div class="flex items-center justify-between mb-3">
    <h2 class="text-xl font-semibold">Decorations</h2>
  </div>

  {{-- Create --}}
  <form method="POST" action="{{ route('admin.decorations.store') }}" class="bg-white rounded-2xl shadow p-4 mb-4">
    @csrf
    <div class="grid md:grid-cols-3 gap-3">
      <input name="name" placeholder="Name" required class="border rounded p-2"/>
      <input name="price" type="number" step="0.01" min="0" placeholder="Price (LKR)" class="border rounded p-2"/>
      <input name="description" placeholder="Description" class="border rounded p-2"/>
    </div>
    <div class="mt-3 text-right">
      <button class="bg-indigo-600 text-white px-4 py-2 rounded">Add Decoration</button>
    </div>
  </form>

  {{-- List + inline edit --}}
  <div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-sm">
      <thead>
        <tr class="text-left border-b bg-gray-50">
          <th class="p-2">Name</th>
          <th class="p-2">Price</th>
          <th class="p-2">Description</th>
          <th class="p-2 text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($decorations as $it)
          <tr class="border-b">
            <td class="p-2 w-48">{{ $it->name }}</td>
            <td class="p-2 w-32">{{ isset($it->price) ? 'LKR '.number_format((float)$it->price,2) : '-' }}</td>
            <td class="p-2">{{ $it->description }}</td>
            <td class="p-2 text-right w-64">
              <details class="inline-block mr-2">
                <summary class="cursor-pointer px-3 py-1 rounded border">Edit</summary>
                <form method="POST" action="{{ route('admin.decorations.update', $it->_id) }}" class="mt-2 space-y-2">
                  @csrf @method('PUT')
                  <input name="name" value="{{ $it->name }}" class="border rounded p-2 w-full"/>
                  <input name="price" value="{{ $it->price }}" type="number" step="0.01" min="0" class="border rounded p-2 w-full"/>
                  <input name="description" value="{{ $it->description }}" class="border rounded p-2 w-full"/>
                  <div class="text-right">
                    <button class="bg-indigo-600 text-white px-3 py-1 rounded">Save</button>
                  </div>
                </form>
              </details>
              <form action="{{ route('admin.decorations.destroy', $it->_id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this package?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 rounded border border-red-300 text-red-700">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td class="p-3 text-gray-500" colspan="4">No decorations yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

{{-- ===================== MUSIC ===================== --}}
<section id="music" class="mb-2">
  <div class="flex items-center justify-between mb-3">
    <h2 class="text-xl font-semibold">Music Packages</h2>
  </div>

  {{-- Create --}}
  <form method="POST" action="{{ route('admin.music.store') }}" class="bg-white rounded-2xl shadow p-4 mb-4">
    @csrf
    <div class="grid md:grid-cols-3 gap-3">
      <input name="name" placeholder="Name" required class="border rounded p-2"/>
      <input name="price" type="number" step="0.01" min="0" placeholder="Price (LKR)" class="border rounded p-2"/>
      <input name="description" placeholder="Description" class="border rounded p-2"/>
    </div>
    <div class="mt-3 text-right">
      <button class="bg-indigo-600 text-white px-4 py-2 rounded">Add Music</button>
    </div>
  </form>

  {{-- List + inline edit --}}
  <div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-sm">
      <thead>
        <tr class="text-left border-b bg-gray-50">
          <th class="p-2">Name</th>
          <th class="p-2">Price</th>
          <th class="p-2">Description</th>
          <th class="p-2 text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($music as $it)
          <tr class="border-b">
            <td class="p-2 w-48">{{ $it->name }}</td>
            <td class="p-2 w-32">{{ isset($it->price) ? 'LKR '.number_format((float)$it->price,2) : '-' }}</td>
            <td class="p-2">{{ $it->description }}</td>
            <td class="p-2 text-right w-64">
              <details class="inline-block mr-2">
                <summary class="cursor-pointer px-3 py-1 rounded border">Edit</summary>
                <form method="POST" action="{{ route('admin.music.update', $it->_id) }}" class="mt-2 space-y-2">
                  @csrf @method('PUT')
                  <input name="name" value="{{ $it->name }}" class="border rounded p-2 w-full"/>
                  <input name="price" value="{{ $it->price }}" type="number" step="0.01" min="0" class="border rounded p-2 w-full"/>
                  <input name="description" value="{{ $it->description }}" class="border rounded p-2 w-full"/>
                  <div class="text-right">
                    <button class="bg-indigo-600 text-white px-3 py-1 rounded">Save</button>
                  </div>
                </form>
              </details>
              <form action="{{ route('admin.music.destroy', $it->_id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this package?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 rounded border border-red-300 text-red-700">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td class="p-3 text-gray-500" colspan="4">No music packages yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>
@endsection
