<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DecorationCategory;
use Illuminate\Http\Request;

class DecorationCategoryController extends Controller
{
    public function store(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string|max:120',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        DecorationCategory::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Decoration created');
    }

    public function update(Request $r, DecorationCategory $decoration)
    {
        $data = $r->validate([
            'name' => 'required|string|max:120',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $decoration->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Decoration updated');
    }

    public function destroy(DecorationCategory $decoration)
    {
        $decoration->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Decoration deleted');
    }
}
