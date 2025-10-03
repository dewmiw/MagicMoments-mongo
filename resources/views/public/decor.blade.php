@extends('layouts.app')
@section('content')

{{-- ===== HERO ===== --}}
<section class="relative overflow-hidden rounded-3xl mb-10">
  <div class="absolute inset-0">
    <img src="{{ asset('images/decor-hero.jpeg') }}" alt="Decor packages" class="w-full h-full object-cover">
    {{-- softer overlay --}}
    <div class="absolute inset-0 bg-gradient-to-r from-black/30 via-black/10 to-black/30 md:from-black/20 md:via-transparent md:to-black/20"></div>
  </div>

  <div class="relative z-10 px-6 py-16 md:py-24 max-w-6xl mx-auto text-white">
    <p class="uppercase tracking-widest text-white/80 text-xs md:text-sm">Design • Details • Delight</p>
    <h1 class="text-3xl md:text-5xl font-extrabold mt-2">Decoration Packages</h1>
    <p class="mt-3 max-w-3xl text-white/90">Elegant themes, floral artistry, and lighting that set the perfect tone for your celebration.</p>

    <div class="mt-6 grid grid-cols-3 max-w-md text-center gap-4">
      <div>
        <div class="text-2xl font-bold">{{ $decorations->count() }}</div>
        <div class="text-white/80 text-xs">Packages</div>
      </div>
      <div>
        <div class="text-2xl font-bold">Bespoke</div>
        <div class="text-white/80 text-xs">Theme Styling</div>
      </div>
      <div>
        <div class="text-2xl font-bold">Luxe</div>
        <div class="text-white/80 text-xs">Finishing Touches</div>
      </div>
    </div>
  </div>
</section>

{{-- ===== DECOR GRID ===== --}}
@if($decorations->isEmpty())
  <div class="bg-white rounded-2xl shadow p-8 text-center">
    <h2 class="text-xl font-semibold mb-2">No decoration packages yet</h2>
    <p class="text-gray-600 mb-4">We’re crafting new looks. Check back soon!</p>
    <a href="{{ route('book.create') }}" class="inline-block bg-indigo-600 text-white px-5 py-2.5 rounded-xl hover:bg-indigo-700">
      Start a Booking
    </a>
  </div>
@else
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($decorations as $d)
      <article class="group bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        {{-- Package image (optional). Add $d->image (storage path) to show; falls back to a soft gradient --}}
        @if(!empty($d->image))
          <div class="relative">
            <img src="{{ Storage::url($d->image) }}" alt="{{ $d->name }}" class="w-full h-44 md:h-52 object-cover">
            @isset($d->price)
              <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-3 py-1.5 rounded-full text-sm font-semibold">
                LKR {{ number_format((float)$d->price, 2) }}
              </div>
            @endisset
          </div>
        @else
          <div class="relative h-24 bg-gradient-to-r from-indigo-50 to-white">
            @isset($d->price)
              <div class="absolute top-3 right-3 bg-gray-900/80 text-white px-3 py-1.5 rounded-full text-sm font-semibold">
                LKR {{ number_format((float)$d->price, 2) }}
              </div>
            @endisset
          </div>
        @endif

        <div class="p-5">
          <h3 class="font-semibold text-lg">{{ $d->name }}</h3>
          <p class="text-sm text-gray-600 mt-1">{{ $d->description }}</p>

          {{-- Optional per-package gallery thumbnails if you add $d->gallery = ['path1','path2',...] --}}
          @if(isset($d->gallery) && is_array($d->gallery) && count($d->gallery))
            <div class="mt-3 flex gap-2 flex-wrap">
              @foreach(array_slice($d->gallery, 0, 4) as $g)
                <img src="{{ Storage::url($g) }}" class="h-12 w-12 object-cover rounded" alt="decor sample">
              @endforeach
            </div>
          @endif

          <div class="mt-5 flex items-center justify-between">
            <a href="{{ route('book.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-indigo-700">
              Book with this Decor
            </a>
            <a href="{{ route('decor') }}" class="text-xs text-gray-500 group-hover:text-gray-700">View all décor</a>
          </div>
        </div>
      </article>
    @endforeach
  </div>
@endif

{{-- ===== FEATURED DECOR GALLERY ===== --}}
<section class="mt-10">
  <h2 class="text-2xl md:text-3xl font-semibold mb-4">A Glimpse of Our Décor</h2>
  <p class="text-gray-600 mb-4">From timeless florals to modern minimalism—here’s a peek at recent looks.</p>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <img src="{{ asset('images/decor-1.jpeg') }}" class="rounded-2xl object-cover w-full h-40 md:h-48" alt="Decor 1">
    <img src="{{ asset('images/decor-2.jpeg') }}" class="rounded-2xl object-cover w-full h-40 md:h-48" alt="Decor 2">
    <img src="{{ asset('images/decor-3.jpeg') }}" class="rounded-2xl object-cover w-full h-40 md:h-48" alt="Decor 3">
    <img src="{{ asset('images/decor-4.jpeg') }}" class="rounded-2xl object-cover w-full h-40 md:h-48" alt="Decor 4">
  </div>
</section>

{{-- ===== FINAL CTA ===== --}}
<section class="mt-10 bg-white rounded-2xl shadow p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
  <div>
    <h2 class="text-xl md:text-2xl font-semibold">Have a theme in mind?</h2>
    <p class="text-gray-600">Share your palette, mood, and venue—we’ll tailor the styling end-to-end.</p>
  </div>
  <a href="{{ route('book.create') }}" class="inline-block bg-gray-900 text-white px-5 py-2.5 rounded-xl hover:bg-black">
    Start a Booking
  </a>
</section>

@endsection
