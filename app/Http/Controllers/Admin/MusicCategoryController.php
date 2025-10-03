<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MusicCategory;
use Illuminate\Http\Request;

class MusicCategoryController extends Controller
{
    public function store(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string|max:120',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        MusicCategory::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Music package created');
    }

    public function update(Request $r, MusicCategory $music)
    {
        $data = $r->validate([
            'name' => 'required|string|max:120',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $music->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Music package updated');
    }

    public function destroy(MusicCategory $music)
    {
        $music->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Music package deleted');
    }
}
