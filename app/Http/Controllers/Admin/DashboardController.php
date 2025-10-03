<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\FoodMenu;
use App\Models\DecorationCategory;
use App\Models\MusicCategory;

class DashboardController extends Controller
{
    public function index()
    {
        // Recent bookings (Mongo): order by _id desc is a simple proxy for newest-first
        $bookings = Booking::orderBy('_id', 'desc')->limit(50)->get();

        // Catalog items for inline CRUD (shown on the dashboard)
        $menus       = FoodMenu::orderBy('name', 'asc')->get();
        $decorations = DecorationCategory::orderBy('name', 'asc')->get();
        $music       = MusicCategory::orderBy('name', 'asc')->get();

        // Basic stats (used in the header cards)
        $stats = [
            'totalBookings'    => Booking::count(),
            'totalMenus'       => FoodMenu::count(),
            'totalDecorations' => DecorationCategory::count(),
            'totalMusic'       => MusicCategory::count(),
        ];

        return view('admin.dashboard', compact('bookings', 'menus', 'decorations', 'music', 'stats'));
    }
}
