@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Book Your Event</h1>
<form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-6 bg-white p-6 rounded-2xl shadow">
@csrf
<div class="space-y-4">
<div>
<label class="block text-sm font-medium">Full Name</label>
<input name="name" value="{{ old('name') }}" required class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Email</label>
<input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Phone</label>
<input name="phone" value="{{ old('phone') }}" class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Event Type</label>
<input name="event_type" value="{{ old('event_type') }}" required class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Event Date</label>
<input type="date" name="event_date" value="{{ old('event_date') }}" required class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Guests</label>
<input type="number" min="1" name="guests" value="{{ old('guests') }}" class="mt-1 w-full border rounded p-2"/>
</div>
</div>


<div class="space-y-4">
<div>
<label class="block text-sm font-medium">Food Preferences</label>
<textarea name="food_pref" rows="3" class="mt-1 w-full border rounded p-2">{{ old('food_pref') }}</textarea>
</div>
<div>
<label class="block text-sm font-medium">Music Preferences</label>
<textarea name="music_pref" rows="3" class="mt-1 w-full border rounded p-2">{{ old('music_pref') }}</textarea>
</div>
<div>
<label class="block text-sm font-medium">Decoration Preferences</label>
<textarea name="deco_pref" rows="3" class="mt-1 w-full border rounded p-2">{{ old('deco_pref') }}</textarea>
</div>
<div>
<label class="block text-sm font-medium">Reference Images (optional)</label>
<input type="file" name="images[]" multiple accept="image/*" class="mt-1"/>
<p class="text-xs text-gray-500 mt-1">Up to a few images; max ~4MB each.</p>
</div>
<div>
<label class="block text-sm font-medium">Notes</label>
<textarea name="notes" rows="3" class="mt-1 w-full border rounded p-2">{{ old('notes') }}</textarea>
</div>
</div>


<div class="md:col-span-2">
<button class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700">Submit Booking</button>
</div>
</form>
@endsection