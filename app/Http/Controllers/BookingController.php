<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;


class BookingController extends Controller
{
public function create()
{
    $menus       = \App\Models\FoodMenu::orderBy('name')->get();
    $music       = \App\Models\MusicCategory::orderBy('name')->get();
    $decorations = \App\Models\DecorationCategory::orderBy('name')->get();

    return view('public.book', compact('menus','music','decorations'));
}



public function store(Request $request)
{
$data = $request->validate([
'name' => 'required|string|max:120',
'email' => 'required|email',
'phone' => 'nullable|string|max:40',
'event_type' => 'required|string|max:60',
'event_date' => 'required|date',
'guests' => 'nullable|integer|min:1',
'food_pref' => 'nullable|string',
'music_pref' => 'nullable|string',
'deco_pref' => 'nullable|string',
'notes' => 'nullable|string|max:2000',
'images.*' => 'nullable|image|max:4096', // up to 4MB each
]);


$paths = [];
if ($request->hasFile('images')) {
foreach ($request->file('images') as $file) {
$paths[] = $file->store('uploads/bookings', 'public');
}
}
$data['images'] = $paths;


Booking::create($data);


return redirect()->route('book.create')->with('success', 'Thank you! Your booking was submitted.');
}



}

