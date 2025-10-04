@extends('layouts.app')
@section('content')

{{-- Page header (no hero image) --}}
<header class="mb-8">
  <div>
    <p class="uppercase tracking-widest text-xs text-gray-500">Sound & Ambience</p>
    <h1 class="text-3xl md:text-4xl font-medium font-serif tracking-tight text-gray-900">
      The Music Collection
    </h1>
    <div class="mt-3 h-0.5 w-24 bg-gradient-to-r from-amber-500 to-rose-300 rounded-full"></div>
  </div>
  <p class="mt-2 text-gray-600 max-w-2xl">
    From smooth jazz to high-energy DJ sets, we curate performers and playlists that match your crowd and timeline.
    AV coordination and emcee services available on request.
  </p>
</header>

{{-- Empty state --}}
@if($music->isEmpty())
  <div class="bg-white rounded-2xl shadow p-8 text-center">
    <h2 class="text-xl font-semibold mb-2">Music coming soon</h2>
    <p class="text-gray-600 mb-4">We’re curating our roster. Share your vibe and we’ll arrange the perfect set.</p>
    <a href="{{ route('book.create') }}" class="inline-block bg-gray-900 text-white px-5 py-2.5 rounded-xl hover:bg-black">
      Request a Lineup
    </a>
  </div>
@else

  {{-- Spotlight Sets (hardcoded, no images) --}}
  <section class="mb-10">
    <div class="flex items-center justify-between mb-3">
      <h2 class="text-xl font-semibold">Spotlight Sets</h2>
      <span class="text-xs px-2 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">Editor’s picks</span>
    </div>
    @php
      $spot = [
        ['name' => 'Sunset Jazz Quartet', 'tag' => 'Warm cocktail-hour grooves'],
        ['name' => 'Island Groove DJ', 'tag' => 'Top 40 • Sinhala • Tamil • EDM'],
        ['name' => 'Classical Strings Trio', 'tag' => 'Ceremony & dinner elegance'],
      ];
      $grad = [
        'from-indigo-50 to-white',
        'from-emerald-50 to-white',
        'from-rose-50 to-white',
      ];
    @endphp
    <div class="grid md:grid-cols-3 gap-6">
      @foreach($spot as $i => $s)
        <article class="group bg-white rounded-2xl shadow hover:shadow-md transition overflow-hidden">
          <div class="relative h-20 bg-gradient-to-r {{ $grad[$i] ?? 'from-indigo-50 to-white' }}">
            <div class="absolute left-4 bottom-3 inline-flex items-center gap-2 text-indigo-700">
              <span class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-white shadow">
                {{-- music note icon --}}
                <svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor">
                  <path d="M9 3v10.56A3.5 3.5 0 1 0 11 17V8.47l8-1.78V13.5a3.5 3.5 0 1 0 2 3.15V4.5L9 3z"/>
                </svg>
              </span>
              <div>
                <div class="font-semibold text-gray-900">{{ $s['name'] }}</div>
                <div class="text-xs text-gray-600">{{ $s['tag'] }}</div>
              </div>
            </div>
          </div>
          <div class="p-4 flex items-center justify-between">
            <a href="{{ route('book.create') }}"
               class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-900 text-white text-sm hover:bg-black">
              Book this
            </a>
            <a href="#all-music" class="text-xs text-gray-500 group-hover:text-gray-700">View all packages</a>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  {{-- Guidance strip --}}
  <section class="mb-8 rounded-2xl border bg-white p-5">
    <div class="grid sm:grid-cols-3 gap-4 text-sm">
      <div><span class="font-medium">Genres:</span> Jazz, pop, classics, Sinhala/Tamil, EDM, retro.</div>
      <div><span class="font-medium">Equipment:</span> PA, mics, mixers, lighting on request.</div>
      <div><span class="font-medium">Timeline:</span> Ceremony, cocktails, dinner, party sets.</div>
    </div>
  </section>

  {{-- All Music Packages --}}
  <section id="all-music" class="mb-4">
    <div class="flex items-center justify-between mb-3">
      <h2 class="text-xl font-semibold">All Packages</h2>
      <div class="text-sm text-gray-500">{{ $music->count() }} available</div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($music as $x)
        <article class="group bg-white rounded-2xl shadow hover:shadow-md transition overflow-hidden">
          <div class="relative h-20 bg-gradient-to-r from-indigo-50 to-white">
            @isset($x->price)
              <div class="absolute top-2 right-3 bg-gray-900/80 text-white px-3 py-1.5 rounded-full text-sm font-semibold">
                LKR {{ number_format((float)$x->price, 2) }}
              </div>
            @endisset
            <div class="absolute left-4 bottom-3 inline-flex items-center gap-2 text-indigo-700">
              <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100">
                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="currentColor">
                  <path d="M9 3v10.56A3.5 3.5 0 1 0 11 17V8.47l8-1.78V13.5a3.5 3.5 0 1 0 2 3.15V4.5L9 3z"/>
                </svg>
              </span>
              <h3 class="font-semibold text-gray-900">{{ $x->name }}</h3>
            </div>
          </div>

          <div class="p-5">
            <p class="text-sm text-gray-600">{{ $x->description }}</p>

            {{-- Feature chips (if you add $x->features array) or parse first 4 from description --}}
            @php
              $chips = [];
              if (isset($x->features) && is_array($x->features)) {
                $chips = array_slice($x->features, 0, 6);
              } elseif (!empty($x->description) && str_contains($x->description, ',')) {
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
              <a href="{{ route('book.create') }}"
                 class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border hover:bg-gray-50 text-sm">
                Select this Package
              </a>
              <span class="text-xs text-gray-500">Typical set: 2 × 45 mins</span>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  {{-- ===== PAST EVENTS WITH MUSIC ===== --}}
<section id="past-events" class="mt-10">
  <div class="flex items-end justify-between mb-2">
    <div>
      <p class="uppercase tracking-widest text-xs text-gray-500">Memories in Motion</p>
      <h2 class="text-2xl md:text-3xl font-semibold">Past Events with Music</h2>
    </div>
    <a href="{{ route('book.create') }}"
       class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-900 text-white text-sm hover:bg-black">
      Plan Yours
    </a>
  </div>
  <p class="text-gray-600 mb-5">A peek at recent celebrations—great vibes, full dance floors, and seamless sound.</p>

  @php
    $events = [
      [
        'name' => 'Rooftop Wedding — Colombo',
        'img' => asset('images/rooftop-wedding.jpeg'),
        'blurb' => 'Sunset jazz into a high-energy DJ set',
        'stats' => ['120 guests','Jazz Quartet + DJ','9 PM finish'],
        'quote' => 'The dance floor never emptied—perfect flow from cocktails to party.',
      ],
      [
        'name' => 'Corporate Gala — Cinnamon Lakeside',
        'img' => asset('images/corporate-gala.jpeg'),
        'blurb' => 'Elegant strings & curated dinner playlist',
        'stats' => ['300 guests','Strings Trio','Pro AV'],
        'quote' => 'Polished, timely, and perfectly matched to our program.',
      ],
      [
        'name' => 'Garden Engagement — Kandy',
        'img' => asset('images/garden-engagement.jpeg'),
        'blurb' => 'Acoustic duo with romantic setlist',
        'stats' => ['80 guests','Acoustic Duo','Early evening'],
        'quote' => 'Gentle ambience that had everyone smiling—so tasteful.',
      ],
      [
        'name' => 'Beach Party — Bentota',
        'img' => asset('images/beach-party.jpeg'),
        'blurb' => 'Tropical house & Sinhala hits',
        'stats' => ['150 guests','DJ + Sax','Light show'],
        'quote' => 'Incredible energy—our best team outing yet!',
      ],
      [
        'name' => 'Awards Night — Colombo',
        'img' => asset('images/awards-night.jpeg'),
        'blurb' => 'Walk-up stings & celebratory anthems',
        'stats' => ['250 guests','House Band','Stage cues'],
        'quote' => 'Flawless cues, crisp sound—made the show feel world-class.',
      ],
      [
        'name' => 'Charity Ball — Mount Lavinia',
        'img' => asset('images/charity-ball.jpeg'),
        'blurb' => 'Retro pop with live horn section',
        'stats' => ['200 guests','Live Band','Encore!'],
        'quote' => 'Crowd loved it—couldn’t stop dancing even after lights up.',
      ],
    ];
  @endphp

  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($events as $e)
      <article class="group bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
        <a href="{{ $e['img'] }}" target="_blank" class="block relative">
          <img src="{{ $e['img'] }}" alt="{{ $e['name'] }}" class="w-full h-44 md:h-56 object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/10 to-transparent"></div>
          <div class="absolute bottom-3 left-4 right-4">
            <div class="text-white font-semibold drop-shadow">{{ $e['name'] }}</div>
            <div class="text-white/90 text-xs">{{ $e['blurb'] }}</div>
          </div>
        </a>
        <div class="p-4">
          <div class="flex flex-wrap gap-2 mb-2">
            @foreach($e['stats'] as $s)
              <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 text-xs">{{ $s }}</span>
            @endforeach
          </div>
          <p class="text-sm text-gray-600 italic">“{{ $e['quote'] }}”</p>
        </div>
      </article>
    @endforeach
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
