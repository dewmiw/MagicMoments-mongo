@extends('layouts.app')
@section('content')
<div class="flex items-center justify-between mb-4">
<h1 class="text-2xl font-semibold">Music Packages</h1>
<a href="{{ route('music.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">New Package</a>
</div>
<div class="bg-white rounded-2xl shadow p-4">
<table class="w-full text-sm">
<thead>
<tr class="text-left border-b">
<th class="p-2">Name</th>
<th class="p-2">Price</th>
<th class="p-2">Description</th>
<th class="p-2"></th>
</tr>
</thead>
<tbody>
@forelse($items as $it)
<tr class="border-b">
<td class="p-2">{{ $it->name }}</td>
<td class="p-2">{{ isset($it->price) ? 'LKR '.number_format((float)$it->price,2) : '-' }}</td>
<td class="p-2">{{ $it->description }}</td>
<td class="p-2 text-right">
<a href="{{ route('music.edit', $it->_id) }}" class="px-3 py-1 rounded border hover:bg-gray-50">Edit</a>
<form action="{{ route('music.destroy', $it->_id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this package?')">
@csrf @method('DELETE')
<button class="px-3 py-1 rounded border border-red-300 text-red-700 hover:bg-red-50">Delete</button>
</form>
</td>
</tr>
@empty
<tr><td class="p-3 text-gray-500" colspan="4">No music packages yet.</td></tr>
@endforelse
</tbody>
</table>
</div>
@endsection