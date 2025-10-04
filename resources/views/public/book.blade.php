@extends('layouts.app')
@section('content')

{{-- Page header --}}
<header class="mb-6">
  <div>
    <p class="uppercase tracking-widest text-xs text-gray-500">Plan Your Celebration</p>
    <h1 class="text-3xl md:text-4xl font-medium font-serif tracking-tight text-gray-900">
      Book Your Event
    </h1>
    <div class="mt-3 h-0.5 w-24 bg-gradient-to-r from-amber-500 to-rose-300 rounded-full"></div>
  </div>
  <p class="mt-2 text-gray-600 max-w-2xl">
    Share your details and preferences—we’ll confirm availability and send a tailored proposal within 24 hours.
  </p>
</header>

{{-- Layout: form + helpful sidebar --}}
<div class="grid md:grid-cols-3 gap-6">
  {{-- ================= FORM ================= --}}
  <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data"
        class="md:col-span-2 space-y-6">
    @csrf

    {{-- Section: Event Details --}}
    <section class="bg-white rounded-2xl shadow p-5">
      <h2 class="text-lg font-semibold mb-4">Event Details</h2>
      <div class="grid md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Event Type <span class="text-red-500">*</span></label>
          <input name="event_type" value="{{ old('event_type') }}" required class="mt-1 w-full border rounded p-2"/>
          @error('event_type')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Event Date <span class="text-red-500">*</span></label>
          <input type="date" name="event_date" value="{{ old('event_date') }}" required class="mt-1 w-full border rounded p-2"/>
          @error('event_date')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Guests</label>
          <input type="number" min="1" name="guests" value="{{ old('guests') }}" class="mt-1 w-full border rounded p-2"/>
          @error('guests')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
    </section>

    {{-- Section: Your Details --}}
    <section class="bg-white rounded-2xl shadow p-5">
      <h2 class="text-lg font-semibold mb-4">Your Details</h2>
      <div class="grid md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Full Name <span class="text-red-500">*</span></label>
          <input name="name" value="{{ old('name') }}" required class="mt-1 w-full border rounded p-2"/>
          @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Email <span class="text-red-500">*</span></label>
          <input type="email" name="email" value="{{ old('email') }}" required
                 class="mt-1 w-full border rounded p-2" inputmode="email"/>
          <p class="text-xs text-gray-500 mt-1">We’ll send your confirmation here.</p>
          @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Phone</label>
          <input name="phone" value="{{ old('phone') }}"
                 class="mt-1 w-full border rounded p-2"
                 inputmode="tel"
                 pattern="^(?:\+94|0)7\d{8}$"
                 placeholder="+9471XXXXXXX or 07XXXXXXXX" />
          <p class="text-xs text-gray-500 mt-1">Sri Lanka: 07XXXXXXXX or +94 7XXXXXXXX</p>
          @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
    </section>

    {{-- Section: Packages --}}
    <section class="bg-white rounded-2xl shadow p-5">
      <h2 class="text-lg font-semibold mb-4">Packages (optional)</h2>
      <div class="grid md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Food Menu</label>
          <select name="selected_menu_id" class="mt-1 w-full border rounded p-2">
            <option value="">— Select a menu —</option>
            @foreach($menus as $m)
              <option value="{{ (string)$m->_id }}" {{ old('selected_menu_id')==(string)$m->_id ? 'selected' : '' }}>
                {{ $m->name }} @if(isset($m->price_per_person)) — LKR {{ number_format((float)$m->price_per_person,2) }}/pax @endif
              </option>
            @endforeach
          </select>
          @error('selected_menu_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Music Package</label>
          <select name="selected_music_id" class="mt-1 w-full border rounded p-2">
            <option value="">— Select music —</option>
            @foreach($music as $x)
              <option value="{{ (string)$x->_id }}" {{ old('selected_music_id')==(string)$x->_id ? 'selected' : '' }}>
                {{ $x->name }} @if(isset($x->price)) — LKR {{ number_format((float)$x->price,2) }} @endif
              </option>
            @endforeach
          </select>
          @error('selected_music_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Décor Package</label>
          <select name="selected_decor_id" class="mt-1 w-full border rounded p-2">
            <option value="">— Select décor —</option>
            @foreach($decorations as $d)
              <option value="{{ (string)$d->_id }}" {{ old('selected_decor_id')==(string)$d->_id ? 'selected' : '' }}>
                {{ $d->name }} @if(isset($d->price)) — LKR {{ number_format((float)$d->price,2) }} @endif
              </option>
            @endforeach
          </select>
          @error('selected_decor_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
    </section>

    {{-- Section: Preferences --}}
    <section class="bg-white rounded-2xl shadow p-5">
      <h2 class="text-lg font-semibold mb-4">Preferences</h2>
      <div class="grid md:grid-cols-3 gap-4">
        <div class="md:col-span-1">
          <label class="block text-sm font-medium">Food Preferences</label>
          <textarea name="food_pref" rows="4" class="mt-1 w-full border rounded p-2">{{ old('food_pref') }}</textarea>
          @error('food_pref')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-1">
          <label class="block text-sm font-medium">Music Preferences</label>
          <textarea name="music_pref" rows="4" class="mt-1 w-full border rounded p-2">{{ old('music_pref') }}</textarea>
          @error('music_pref')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-1">
          <label class="block text-sm font-medium">Decoration Preferences</label>
          <textarea name="deco_pref" rows="4" class="mt-1 w-full border rounded p-2">{{ old('deco_pref') }}</textarea>
          @error('deco_pref')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
    </section>

    {{-- Section: References & Notes --}}
    <section class="bg-white rounded-2xl shadow p-5">
      <h2 class="text-lg font-semibold mb-4">References & Notes</h2>
      <div class="grid md:grid-cols-3 gap-4">
        <div class="md:col-span-2">
          <label class="block text-sm font-medium">Reference Images (optional)</label>
          <div class="mt-1 border-2 border-dashed rounded-xl p-4 text-sm text-gray-600">
            <input type="file" name="images[]" multiple accept="image/*" />
            <p class="text-xs mt-1">Upload a few images; max ~4MB each.</p>
          </div>
          @error('images')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
          @error('images.*')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-1">
          <label class="block text-sm font-medium">Notes</label>
          <textarea name="notes" rows="5" class="mt-1 w-full border rounded p-2">{{ old('notes') }}</textarea>
          @error('notes')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
    </section>

    {{-- Submit --}}
    <div class="flex items-center justify-between">
      <p class="text-xs text-gray-500">By submitting, you agree to be contacted about your event details.</p>
      <button class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gray-900 text-white font-medium hover:bg-black">
        Submit Booking
      </button>
    </div>
  </form>

  {{-- ================= SIDEBAR ================= --}}
  <aside class="md:col-span-1 space-y-6">
    <div class="bg-white rounded-2xl shadow p-5">
      <h3 class="text-sm font-semibold mb-2">Helpful tips</h3>
      <ul class="text-sm text-gray-600 space-y-2 list-disc ml-5">
        <li>Pick a realistic guest count (±10%) for accurate pricing.</li>
        <li>Share dietary notes and must-play / do-not-play songs.</li>
        <li>Upload venue photos or a moodboard for décor.</li>
      </ul>
    </div>

    <div class="bg-white rounded-2xl shadow p-5">
      <h3 class="text-sm font-semibold mb-2">Need help?</h3>
      <div class="text-sm text-gray-700 space-y-1">
        <div>Call: <a href="tel:+94711234567" class="text-indigo-700 hover:underline">+94 71 123 4567</a></div>
        <div>Email: <a href="mailto:hello@magicmoments.lk" class="text-indigo-700 hover:underline">hello@magicmoments.lk</a></div>
        <div>WhatsApp: <a href="https://wa.me/94711234567" target="_blank" class="text-indigo-700 hover:underline">+94 71 123 4567</a></div>
      </div>
      <p class="text-xs text-gray-500 mt-3">Mon–Fri 9:00–18:00 • Colombo</p>
    </div>
  </aside>
</div>

@endsection
