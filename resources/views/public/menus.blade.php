@extends('layouts.app')
@section('content')

{{-- ===== HERO ===== --}}
<section class="relative overflow-hidden rounded-3xl mb-10">
<div class="absolute inset-0 bg-black/20">
        <img src="{{ asset('images/menus-hero.jpg') }}" alt="Food menus" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-black/60"></div>
  </div>

  <div class="relative z-10 px-6 py-16 md:py-24 max-w-6xl mx-auto text-white">
    <p class="uppercase tracking-widest text-white/80 text-xs md:text-sm">Crafted Cuisine • Crowd-Pleasers</p>
    <h1 class="text-3xl md:text-5xl font-extrabold mt-2">Food Menus</h1>
    <p class="mt-3 max-w-3xl text-white/90">Buffets and plated selections tailored to your event. Vegetarian and halal-friendly options on request.</p>

    <div class="mt-6 grid grid-cols-3 max-w-md text-center gap-4">
      <div>
        <div class="text-2xl font-bold">{{ $menus->count() }}</div>
        <div class="text-white/80 text-xs">Menus</div>
      </div>
      <div>
        <div class="text-2xl font-bold">Custom</div>
        <div class="text-white/80 text-xs">Adaptable Items</div>
      </div>
      <div>
        <div class="text-2xl font-bold">Fresh</div>
        <div class="text-white/80 text-xs">Locally Inspired</div>
      </div>
    </div>
  </div>
</section>

{{-- ===== MENUS GRID ===== --}}
@if($menus->isEmpty())
  <div class="bg-white rounded-2xl shadow p-8 text-center">
    <h2 class="text-xl font-semibold mb-2">No menus yet</h2>
    <p class="text-gray-600 mb-4">We’re curating something delicious. Check back soon!</p>
    <a href="{{ route('book.create') }}" class="inline-block bg-indigo-600 text-white px-5 py-2.5 rounded-xl hover:bg-indigo-700">
      Start a Booking
    </a>
  </div>
@else
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($menus as $m)
      <article class="group bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        {{-- Image (optional) --}}
        @if(!empty($m->image))
          <div class="relative">
            <img src="{{ Storage::url($m->image) }}" alt="{{ $m->name }}" class="w-full h-44 md:h-52 object-cover">
            @isset($m->price_per_person)
              <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-3 py-1.5 rounded-full text-sm font-semibold">
                LKR {{ number_format((float)$m->price_per_person, 2) }} / person
              </div>
            @endisset
          </div>
        @else
          <div class="relative h-24 bg-gradient-to-r from-indigo-50 to-white"></div>
        @endif

        <div class="p-5">
          <h3 class="font-semibold text-lg">{{ $m->name }}</h3>
          @isset($m->price_per_person)
            <div class="mt-1 text-indigo-700 font-medium md:hidden">
              LKR {{ number_format((float)$m->price_per_person, 2) }} / person
            </div>
          @endisset
          <p class="text-sm text-gray-600 mt-1">{{ $m->description }}</p>

          {{-- Items as chips (show first 6, rest collapsible) --}}
          @if(is_array($m->items) && count($m->items))
            @php
              $shown = array_slice($m->items, 0, 6);
              $hidden = array_slice($m->items, 6);
            @endphp
            <div class="mt-3 flex flex-wrap gap-2">
              @foreach($shown as $it)
                <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 text-xs">{{ $it }}</span>
              @endforeach
              @if(count($hidden))
                <details class="w-full">
                  <summary class="text-xs text-indigo-700 cursor-pointer hover:underline">Show more</summary>
                  <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($hidden as $it)
                      <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 text-xs">{{ $it }}</span>
                    @endforeach
                  </div>
                </details>
              @endif
            </div>
          @endif

          <div class="mt-5 flex items-center justify-between">
            <a href="{{ route('book.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-indigo-700">
              Book with this Menu
            </a>
            <a href="{{ route('menus') }}" class="text-xs text-gray-500 group-hover:text-gray-700">View all menus</a>
          </div>
        </div>
      </article>
    @endforeach
  </div>
@endif

{{-- ===== FINAL CTA ===== --}}
<section class="mt-10 bg-white rounded-2xl shadow p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
  <div>
    <h2 class="text-xl md:text-2xl font-semibold">Need a custom menu?</h2>
    <p class="text-gray-600">Tell us dietary needs, cuisine preferences, and budget—we’ll tailor it.</p>
  </div>
  <a href="{{ route('book.create') }}" class="inline-block bg-gray-900 text-white px-5 py-2.5 rounded-xl hover:bg-black">
    Start a Booking
  </a>
</section>

@endsection
