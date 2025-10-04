@extends('layouts.app')
@section('content')

{{-- Page header (no hero image) --}}
<header class="mb-8">
  <div>
  <p class="uppercase tracking-widest text-xs text-gray-500">Our Signature Menus</p>
  <h1 class="text-3xl md:text-4xl font-medium font-serif tracking-tight text-gray-900">
    The Culinary Collection
  </h1>
  <div class="mt-3 h-0.5 w-24 bg-gradient-to-r from-amber-500 to-rose-300 rounded-full"></div>
</div>

  <p class="mt-2 text-gray-600 max-w-2xl">
    <br>
  Thoughtfully curated menus that balance tradition and modern taste. Vegetarian and halal-friendly options are
    available—tell us your preferences and we’ll tailor the details.
  </p>
</header>

{{-- Empty state --}}
@if($menus->isEmpty())
  <div class="bg-white rounded-2xl shadow p-8 text-center">
    <h2 class="text-xl font-semibold mb-2">Menus coming soon</h2>
    <p class="text-gray-600 mb-4">We’re crafting something delicious. Check back shortly, or request a custom menu now.</p>
    <a href="{{ route('book.create') }}" class="inline-block bg-gray-900 text-white px-5 py-2.5 rounded-xl hover:bg-black">
      Request a Custom Menu
    </a>
  </div>
@else

  {{-- Chef’s Picks (hardcoded, with images) --}}
<section class="mb-10">
  <div class="flex items-center justify-between mb-3">
    <h2 class="text-xl font-semibold">Chef’s Picks</h2>
    <span class="text-xs px-2 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">Signature selections</span>
  </div>

  @php
    $picks = [
      [
        'name' => 'Spice & Silk Signature',
        'img' => asset('images/spice-silk.jpg'),
        'tagline' => 'Sri Lankan classics with modern flair',
      ],
      [
        'name' => 'Coastal Lagoon Feast',
        'img' => asset('images/coastal-lagoon.jpeg'),
        'tagline' => 'Seafood-forward celebration',
      ],
      [
        'name' => 'Garden Harvest Table (Veg)',
        'img' => asset('images/garden-harvest.jpeg'),
        'tagline' => 'Seasonal, plant-forward comfort',
      ],
    ];
  @endphp

  <div class="grid md:grid-cols-3 gap-6">
    @foreach($picks as $p)
      <article class="group bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        <div class="relative">
          <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" class="w-full h-44 md:h-56 object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-black/10 to-transparent"></div>
          <div class="absolute bottom-3 left-4 right-4">
            <div class="text-white text-lg font-semibold drop-shadow">{{ $p['name'] }}</div>
            <div class="text-white/90 text-xs">{{ $p['tagline'] }}</div>
          </div>
        </div>
        <div class="p-4 flex items-center justify-between">
          <a href="{{ route('book.create') }}"
             class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-900 text-white text-sm hover:bg-black">
            Book this
          </a>
          <a href="#all-menus" class="text-xs text-gray-500 group-hover:text-gray-700">View all menus</a>
        </div>
      </article>
    @endforeach
  </div>
</section>


  {{-- Small guidance strip --}}
  <section class="mb-8 rounded-2xl border bg-white p-5">
    <div class="grid sm:grid-cols-3 gap-4 text-sm">
      <div><span class="font-medium">Dietary notes:</span> Vegetarian, vegan, and halal options available.</div>
      <div><span class="font-medium">Tastings:</span> On request for weddings and large events.</div>
      <div><span class="font-medium">Customization:</span> Swap or add dishes to suit your theme.</div>
    </div>
  </section>

  {{-- All Menus --}}
  <section class="mb-4">
    <div class="flex items-center justify-between mb-3">
      <h2 class="text-xl font-semibold">All Menus</h2>
      <div class="text-sm text-gray-500">{{ $menus->count() }} available</div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($menus as $m)
        <article class="group bg-white rounded-2xl shadow hover:shadow-md transition p-5">
          <div class="flex items-start justify-between">
            <h3 class="font-semibold text-lg">{{ $m->name }}</h3>
            @isset($m->price_per_person)
              <div class="ml-3 shrink-0 text-sm font-semibold text-indigo-700">
                LKR {{ number_format((float)$m->price_per_person, 2) }} <span class="text-gray-500 text-xs">/ person</span>
              </div>
            @endisset
          </div>
          <p class="text-sm text-gray-600 mt-1">{{ $m->description }}</p>

          @if(is_array($m->items) && count($m->items))
            @php $shown = array_slice($m->items, 0, 6); $rest = array_slice($m->items, 6); @endphp
            <div class="mt-3 flex flex-wrap gap-2">
              @foreach($shown as $it)
                <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 text-xs">{{ $it }}</span>
              @endforeach
              @if(count($rest))
                <details class="w-full">
                  <summary class="text-xs text-indigo-700 cursor-pointer hover:underline">Show more</summary>
                  <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($rest as $it)
                      <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 text-xs">{{ $it }}</span>
                    @endforeach
                  </div>
                </details>
              @endif
            </div>
          @endif

          <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('book.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border hover:bg-gray-50 text-sm">
              Select this Menu
            </a>
            <span class="text-xs text-gray-500">Lead time: 5–7 days</span>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  {{-- FAQ-lite (collapsible) --}}
  <section class="mt-8">
    <h3 class="text-lg font-semibold mb-2">Good to know</h3>
    <div class="bg-white rounded-2xl shadow divide-y">
      <details class="p-4">
        <summary class="font-medium cursor-pointer">Can we mix items from different menus?</summary>
        <p class="mt-2 text-sm text-gray-600">Yes. Treat our menus as starting points—tell us your must-haves and we’ll tailor a hybrid menu.</p>
      </details>
      <details class="p-4">
        <summary class="font-medium cursor-pointer">Do you cater special diets?</summary>
        <p class="mt-2 text-sm text-gray-600">Absolutely—vegetarian, vegan, gluten-free, and halal options are available. We can label dishes clearly at the event.</p>
      </details>
      <details class="p-4">
        <summary class="font-medium cursor-pointer">What’s included in the price?</summary>
        <p class="mt-2 text-sm text-gray-600">Menu pricing covers food preparation. Service staff, tableware, and live stations can be added based on your needs.</p>
      </details>
    </div>
  </section>
  <br>

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

@endif
@endsection
