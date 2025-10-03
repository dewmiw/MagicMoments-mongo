<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodMenu;
use Illuminate\Http\Request;

class FoodMenuController extends Controller
{
    public function store(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string|max:120',
            'description' => 'nullable|string',
            'price_per_person' => 'nullable|numeric|min:0',
            'items' => 'nullable|string', // comma-separated
        ]);

        if (!empty($data['items'])) {
            $data['items'] = array_map('trim', explode(',', $data['items']));
        }

        FoodMenu::create($data);

        // Avoid non-existent index route
        return redirect()->route('admin.dashboard')->with('success', 'Menu created');
    }

    public function update(Request $r, FoodMenu $food_menu)
    {
        $data = $r->validate([
            'name' => 'required|string|max:120',
            'description' => 'nullable|string',
            'price_per_person' => 'nullable|numeric|min:0',
            'items' => 'nullable|string',
        ]);

        if (!empty($data['items'])) {
            $data['items'] = array_map('trim', explode(',', $data['items']));
        }

        $food_menu->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Menu updated');
    }

    public function destroy(FoodMenu $food_menu)
    {
        $food_menu->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Menu deleted');
    }
}
