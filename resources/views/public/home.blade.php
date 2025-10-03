@extends('layouts.app')
@section('content')
{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden rounded-3xl mb-10">
{{-- Background image (replace with your own) --}}
<div class="absolute inset-0">
<img src="{{ asset('images/hero.jpg') }}" alt="Magic Moments" class="w-full h-full object-cover">
<div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-black/60"></div>
</div>


<div class="relative z-10 px-6 py-20 md:py-28 lg:py-36 max-w-6xl mx-auto text-white">
<p class="uppercase tracking-widest text-sm md:text-base text-white/80">Curate • Celebrate • Remember</p>
<h1 class="text-4xl md:text-6xl font-extrabold mt-3">
<span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-200 to-white">Magic Moments</span>
</h1>
<p class="mt-4 max-w-3xl text-base md:text-lg text-white/90">End-to-end event planning—food, décor, and music—tailored to your vision. Share your preferences, upload references, and we’ll bring your celebration to life.</p>


<div class="mt-8 flex flex-wrap gap-3">
<a href="{{ route('book.create') }}" class="inline-flex items-center gap-2 bg-white text-gray-900 px-5 py-3 rounded-xl font-medium hover:bg-gray-100">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M6.75 2.25a.75.75 0 01.75.75V4.5h9V3a.75.75 0 011.5 0v1.5h.75A2.25 2.25 0 0121 6.75v12A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75v-12A2.25 2.25 0 015.25 4.5H6V3a.75.75 0 01.75-.75zM4.5 9h15v9.75a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9z"/></svg>
Start a Booking
</a>
<a href="{{ route('menus') }}" class="inline-flex items-center gap-2 border border-white/60 px-5 py-3 rounded-xl font-medium hover:bg-white/10">
Explore Menus
</a>
</div>
<div class="mt-10 grid grid-cols-3 gap-6 max-w-xl text-center">
<div>
<div class="text-3xl font-bold">500+</div>
<div class="text-white/80 text-sm">Events Delivered</div>
</div>
<div>
<div class="text-3xl font-bold">4.9/5</div>
<div class="text-white/80 text-sm">Average Rating</div>
</div>
<div>
<div class="text-3xl font-bold">Since 2018</div>
<div class="text-white/80 text-sm">Trusted Experience</div>
</div>
</div>
</div>
</section>

{{-- ================= EVENTS WE COVER ================= --}}
<section class="mb-10">
<h2 class="text-2xl md:text-3xl font-semibold mb-4">Events We Cover</h2>
<p class="text-gray-600 mb-6">From intimate gatherings to grand celebrations—tell us your dream, we’ll handle the details.</p>


<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
@php
$events = [
['Wedding Receptions','Elegant décor, curated menus, live music'],
['Corporate Galas','Seamless experiences, AV, staging, emcees'],
['Birthday Parties','Themes, cakes, kids & adult-friendly menus'],
['Engagements','Floral artistry, ambient lighting, acoustic vibes'],
['Graduations','Photo booths, playlists, fun finger foods'],
['Cultural Ceremonies','Authentic cuisine and traditional aesthetics'],
];
$icons = [
'<path d="M12 3l2.2 4.46 4.92.72-3.56 3.46.84 4.9L12 14.77 7.6 17.54l.84-4.9L4.88 8.18l4.92-.72L12 3z"/>',
'<path d="M2 7l10-4 10 4-10 4L2 7zm0 6l10 4 10-4"/>',
'<path d="M12 2a5 5 0 015 5v2h1a3 3 0 013 3v7H3v-7a3 3 0 013-3h1V7a5 5 0 015-5z"/>',
'<path d="M12 3l9 7-9 7-9-7 9-7z"/>',
'<path d="M4 6h16v2H4zm2 4h12v10H6z"/>',
'<path d="M5 20h14v-2H5v2zM7 4h10l2 4H5l2-4z"/>',
];
@endphp
@foreach($events as $i => $ev)
<div class="bg-white rounded-2xl shadow p-5">
<div class="flex items-center gap-3 mb-2">
<span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-50 text-indigo-700">
<svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor">{!! $icons[$i] !!}</svg>
</span>
<h3 class="font-semibold text-lg">{{ $ev[0] }}</h3>
</div>
<p class="text-sm text-gray-600">{{ $ev[1] }}</p>
</div>
@endforeach
</div>
</section>
{{-- ================= TESTIMONIALS ================= --}}
<section class="mb-10">
<h2 class="text-2xl md:text-3xl font-semibold mb-4">What Clients Say</h2>
<div class="grid md:grid-cols-3 gap-6">
@php
$reviews = [
['A. Perera','Wedding Reception','They handled everything flawlessly—from décor to the band. Our guests still talk about it!'],
['I. Fernando','Corporate Gala','Professional team, stunning setup, and delicious food. Made my job so much easier.'],
['D. Tissera','Birthday Party','They nailed the theme and even curated a playlist. Truly a magic moment for our family.'],
];
@endphp


@foreach($reviews as $r)
<div class="bg-white rounded-2xl shadow p-6">
<div class="flex items-center gap-1 text-amber-500 mb-3" aria-label="5 stars">
@for($i=0;$i<5;$i++)
<svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor"><path d="M12 3l2.2 4.46 4.92.72-3.56 3.46.84 4.9L12 14.77 7.6 17.54l.84-4.9L4.88 8.18l4.92-.72L12 3z"/></svg>
@endfor
</div>
<p class="text-gray-700">“{{ $r[2] }}”</p>
<div class="mt-4 text-sm text-gray-500">— {{ $r[0] }} · {{ $r[1] }}</div>
</div>
@endforeach
</div>
</section>
{{-- ================= GALLERY STRIP ================= --}}
<section class="mb-10">
<h2 class="text-2xl md:text-3xl font-semibold mb-4">A Glimpse of Our Work</h2>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
<img src="{{ asset('images/gallery-1.jpg') }}" class="rounded-2xl object-cover w-full h-40 md:h-48" alt="Event 1">
<img src="{{ asset('images/gallery-2.jpg') }}" class="rounded-2xl object-cover w-full h-40 md:h-48" alt="Event 2">
<img src="{{ asset('images/gallery-3.jpeg') }}" class="rounded-2xl object-cover w-full h-40 md:h-48" alt="Event 3">
<img src="{{ asset('images/gallery-4.jpeg') }}" class="rounded-2xl object-cover w-full h-40 md:h-48" alt="Event 4">
</div>
</section>
{{-- ================= FEATURED (optional dynamic) ================= --}}
<section class="mb-12">
<h2 class="text-2xl md:text-3xl font-semibold mb-4">Explore Our Packages</h2>
<div class="grid md:grid-cols-3 gap-6">
<a href="{{ route('menus') }}" class="group bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
<h3 class="font-semibold text-lg mb-1">Food Menus</h3>
<p class="text-sm text-gray-600">Buffets, plated dinners, and custom cuisines.</p>
<div class="mt-3 text-indigo-700 group-hover:underline">See menus →</div>
</a>
<a href="{{ route('decor') }}" class="group bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
<h3 class="font-semibold text-lg mb-1">Décor Packages</h3>
<p class="text-sm text-gray-600">Themes, florals, lighting, and staging.</p>
<div class="mt-3 text-indigo-700 group-hover:underline">See décor →</div>
</a>
<a href="{{ route('music') }}" class="group bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
<h3 class="font-semibold text-lg mb-1">Music & Entertainment</h3>
<p class="text-sm text-gray-600">Live bands, DJs, emcees, and more.</p>
<div class="mt-3 text-indigo-700 group-hover:underline">See music →</div>
</a>
</div>
</section>
{{-- ================= FINAL CTA ================= --}}
<section class="bg-white rounded-2xl shadow p-8 md:p-10 text-center">
<h2 class="text-2xl md:text-3xl font-semibold">Ready to plan your Magic Moment?</h2>
<p class="text-gray-600 mt-2">Tell us your date and preferences—our team will craft a tailored proposal.</p>
<div class="mt-5">
<a href="{{ route('book.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-xl font-medium hover:bg-indigo-700">Start a Booking</a>
</div>
</section>


@endsection