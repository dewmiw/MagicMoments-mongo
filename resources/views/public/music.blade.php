@extends('layouts.app')
@section('content')

{{-- ===== HERO ===== --}}
<section class="relative overflow-hidden rounded-3xl mb-10">
  <div class="absolute inset-0">
    <img src="{{ asset('images/music-hero.jpeg') }}" alt="Music packages" class="w-full h-full object-cover">
    {{-- softer overlay --}}
    <div class="absolute inset-0 bg-gradient-to-r from-black/30 via-black/10 to-black/30 md:from-black/20 md:via-transparent md:to-black/20"></div>
  </div>

  <div class="relative z-10 px-6 py-16 md:py-24 max-w-6xl mx-auto text-white">
    <p class="uppercase tracking-widest text-white/80 text-xs md:text-sm">Rhythm • Ambience • Energy</p>
    <h1 class="text-3xl md:text-5xl font-extrabold mt-2">Music Packages</h1>
    <p class="mt-3 max-w-3xl text-white/90">Live bands, DJs, emcees, and curated playlists to set the perfect mood for your event.</p>

    <div class="mt-6 grid grid-cols-3 max-w-md text-center gap-4">
      <div>
        <div class="text-2xl font-bold">{{ $music->count() }}</div>
        <div class="text-white/80 text-xs">Packages</div>
      </div>
      <div>
        <div class="text-2xl font-bold">Tailored</div>
        <div class="text-white/80 text-xs">Genres & Sets</div>
      </div>
      <div>
        <div class="text-2xl font-bold">Seamless</div>
        <div class="text-white/80 text-xs">AV Coordination</div>
      </div>
    </div>
  </div>
</section>

{{-- ===== MUSIC GRID ===== --}}
@if($music->isEmpty())
  <div class="bg-white rounded-2xl shadow p-8 text-center">
    <h2 class="text-xl font-semibold mb-2">No music packages yet</h2>
    <p class="text-gray-600 mb-4">We’re tuning up our selections. Check back soon!</p>
    <a href="{{ route('book.create') }}" class="inline-block bg-indigo-600 text-white px-5 py-2.5 rounded-xl hover:bg-indigo-700">
      Start a Booking
    </a>
  </div>
@else
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($music as $x)
      <article class="group bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        {{-- Decorative header (no per-package image needed) --}}
        <div class="relative h-24 bg-gradient-to-r from-indigo-50 to-white">
          @isset($x->price)
            <div class="absolute top-3 right-3 bg-gray-900/80 text-white px-3 py-1.5 rounded-full text-sm font-semibold">
              LKR {{ number_format((float)$x->price, 2) }}
            </div>
          @endisset
          <div class="absolute left-4 bottom-3 inline-flex items-center gap-2 text-indigo-700">
            <span class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-indigo-100">
              {{-- music note icon --}}
              <svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor">
                <path d="M9 3v10.56A3.5 3.5 0 1 0 11 17V8.47l8-1.78V13.5a3.5 3.5 0 1 0 2 3.15V4.5L9 3z"/>
              </svg>
            </span>
            <span class="text-sm font-medium text-gray-700">Professional Setup</span>
          </div>
        </div>

        <div class="p-5">
          <h3 class="font-semibold text-lg">{{ $x->name }}</h3>
          <p class="text-sm text-gray-600 mt-1">{{ $x->description }}</p>

          {{-- Feature chips (auto from description commas, optional) --}}
          @php
            $chips = [];
            if (!empty($x->description) && str_contains($x->description, ',')) {
              $chips = array_slice(array_map('trim', explode(',', $x->description)), 0, 4);
            }
          @endphp
          @if(count($chips))
            <div class="mt-3 flex flex-wrap gap-2">
              @foreach($chips as $c)
                <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 text-xs">{{ $c }}</span>
              @endforeach
            </div>
          @endif

          <div class="mt-5 flex items-center justify-between">
            <a href="{{ route('book.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-indigo-700">
              Book this Music
            </a>
            <a href="{{ route('music') }}" class="text-xs text-gray-500 group-hover:text-gray-700">View all music</a>
          </div>
        </div>
      </article>
    @endforeach
  </div>
@endif

{{-- ===== FINAL CTA ===== --}}
<section class="mt-10 bg-white rounded-2xl shadow p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
  <div>
    <h2 class="text-xl md:text-2xl font-semibold">Looking for a specific vibe?</h2>
    <p class="text-gray-600">Tell us genres, do-not-play lists, and timelines—DJ or live band, we’ll arrange it.</p>
  </div>
  <a href="{{ route('book.create') }}" class="inline-block bg-gray-900 text-white px-5 py-2.5 rounded-xl hover:bg-black">
    Start a Booking
  </a>
</section>

@endsection
