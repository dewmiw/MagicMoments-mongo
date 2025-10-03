@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">New Food Menu</h1>
<form method="POST" action="{{ route('food-menus.store') }}" class="bg-white rounded-2xl shadow p-6 space-y-4">
@csrf
<div>
<label class="block text-sm font-medium">Name</label>
<input name="name" required class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Description</label>
<textarea name="description" rows="3" class="mt-1 w-full border rounded p-2"></textarea>
</div>
<div>
<label class="block text-sm font-medium">Price per person (LKR)</label>
<input type="number" step="0.01" min="0" name="price_per_person" class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Items (comma-separated)</label>
<textarea name="items" rows="2" class="mt-1 w-full border rounded p-2" placeholder="Fried rice, Devilled chicken, Watalappan"></textarea>
</div>
<button class="bg-indigo-600 text-white px-5 py-2 rounded">Create</button>
</form>
@endsection