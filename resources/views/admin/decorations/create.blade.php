@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">New Decoration Package</h1>
<form method="POST" action="{{ route('decorations.store') }}" class="bg-white rounded-2xl shadow p-6 space-y-4">
@csrf
<div>
<label class="block text-sm font-medium">Name</label>
<input name="name" required class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Price (LKR)</label>
<input type="number" step="0.01" min="0" name="price" class="mt-1 w-full border rounded p-2"/>
</div>
<div>
<label class="block text-sm font-medium">Description</label>
<textarea name="description" rows="3" class="mt-1 w-full border rounded p-2"></textarea>
</div>
<button class="bg-indigo-600 text-white px-5 py-2 rounded">Create</button>
</form>
@endsection