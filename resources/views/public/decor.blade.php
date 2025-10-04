@extends('layouts.app')
@section('content')


<header class="mb-8">
  <div>
    <p class="uppercase tracking-widest text-xs text-gray-500">Our Décor Styles</p>
    <h1 class="text-3xl md:text-4xl font-medium font-serif tracking-tight text-gray-900">
      The Design Collection
    </h1>
    <div class="mt-3 h-0.5 w-24 bg-gradient-to-r from-amber-500 to-rose-300 rounded-full"></div>
  </div>
  <br>
  <p class="mt-2 text-gray-600 max-w-2xl">
    Elevated themes, florals, and lighting—styled to your venue and vision. From classic romance to modern minimal,
    we design atmospheres that feel effortless and unforgettable.
  </p>
</header>

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
<br>
<br>

{{-- ===== DECOR GRID ===== --}}
<section>
@if($decorations->isEmpty())
  <div class="bg-white rounded-2xl shadow p-8 text-center">
    <h2 class="text-xl font-semibold mb-2">No decoration packages yet</h2>
    <p class="text-gray-600 mb-4">We’re crafting new looks. Check back soon!</p>
    <a href="{{ route('book.create') }}" class="inline-block bg-indigo-600 text-white px-5 py-2.5 rounded-xl hover:bg-indigo-700">
      Start a Booking
    </a>
  </div>
@else
 <h2 class="text-xl font-semibold">All Packages</h2>
 <br>
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
            <a href="{{ route('book.create') }}" class="inline-flex items-center gap-2 bg-black text-white px-4 py-2 rounded-xl text-sm hover:bg-gray-900">
              Book with this Decor
            </a>
            <a href="{{ route('decor') }}" class="text-xs text-gray-500 group-hover:text-gray-700">View all décor</a>
          </div>
        </div>
      </article>
    @endforeach
  </div>
@endif
</section>
<br>
<br>
 {{-- Guidance strip --}}
  <section class="mb-8 rounded-2xl border bg-white p-5">
    <div class="grid sm:grid-cols-3 gap-4 text-sm">
      <div><span class="font-medium">Themes:</span> Classic, Modern Minimal, Tropical, Rustic, Glam.</div>
      <div><span class="font-medium">Florals & Lighting:</span> Fresh florals, draping, warm LEDs, candlelight.</div>
      <div><span class="font-medium">Logistics:</span> Site visit on request; setup & teardown included.</div>
    </div>
  </section>



  {{-- ================= FINAL CTA + CONTACT ================= --}}
<section class="bg-white rounded-2xl shadow p-8 md:p-10 text-center">
  <h2 class="text-2xl md:text-3xl font-semibold">Ready to plan your Magic Moment?</h2>
  <p class="text-gray-600 mt-2">Tell us your date and preferences—our team will craft a tailored proposal.</p>

  <div class="mt-5 flex flex-col md:flex-row items-center justify-center gap-3">
    <a href="{{ route('book.create') }}"
       class="inline-flex items-center gap-2 bg-gray-300 text-black px-6 py-3 rounded-xl font-medium hover:bg-gray-400">
      Start a Booking
    </a>

    <span class="hidden md:inline text-gray-400">or</span>

    <div class="flex flex-wrap items-center justify-center gap-3">
      <a href="tel:+94711234567"
         class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border hover:bg-gray-50">
        {{-- phone icon --}}
        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="currentColor"><path d="M6.6 10.8a15.7 15.7 0 006.6 6.6l2.2-2.2a1.5 1.5 0 011.6-.36c1.1.37 2.3.57 3.5.57a1.5 1.5 0 011.5 1.5V20a2 2 0 01-2 2C10.1 22 2 13.9 2 4a2 2 0 012-2h3.13A1.5 1.5 0 018.63 3.5c0 1.2.19 2.4.57 3.5a1.5 1.5 0 01-.36 1.6L6.6 10.8z"/></svg>
        Call +94 71 123 4567
      </a>

      <a href="mailto:hello@magicmoments.lk"
         class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border hover:bg-gray-50">
        {{-- mail icon --}}
        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="currentColor"><path d="M2 6a2 2 0 012-2h16a2 2 0 012 2v.2l-10 6L2 6.2V6zm0 3.25V18a2 2 0 002 2h16a2 2 0 002-2V9.25l-9.37 5.62a2 2 0 01-2.26 0L2 9.25z"/></svg>
        Email Us
      </a>

      <a href="https://wa.me/94711234567" target="_blank" rel="noopener"
         class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">
        {{-- WhatsApp icon --}}
        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="currentColor"><path d="M20 3.9A10 10 0 004.2 18.1L3 22l4-1.1A10 10 0 1020 3.9zM6.6 18.7l-.2.1.4-1.4-.1-.2A8 8 0 1118 18a8 8 0 01-11.4.7zM8.8 7.9c.2-.4.3-.4.6-.4h.5c.2 0 .4 0 .5.4s.6 1.2.6 1.3c.1.1.1.3 0 .5-.1.2-.2.4-.4.6s-.4.4-.2.8c.2.3.7 1.1 1.5 1.7.8.5 1.4.7 1.7.5.3-.2.4-.4.6-.6.2-.2.4-.2.6-.1.2.1 1.5.7 1.7.8.2.1.3.1.4.2s.1.6-.2 1.2c-.3.6-1.2 1.1-2 1.1s-2.2-.5-3.1-1.2c-.9-.7-2-2-2.3-2.6-.3-.6-.6-1.6-.4-2 .2-.4.6-1 1-1.4z"/></svg>
        WhatsApp
      </a>
    </div>
  </div>

  <p class="text-xs text-gray-500 mt-4">Mon–Fri 9:00–18:00 • Colombo, Sri Lanka</p>
</section>

@endsection
