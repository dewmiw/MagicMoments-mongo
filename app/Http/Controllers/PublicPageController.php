<?php
namespace App\Http\Controllers;


use App\Models\FoodMenu;
use App\Models\DecorationCategory;
use App\Models\MusicCategory;


class PublicPageController extends Controller
{
public function home() { return view('public.home'); }
public function menus() {
$menus = FoodMenu::all();
return view('public.menus', compact('menus'));
}
public function decor() {
$decorations = DecorationCategory::all();
return view('public.decor', compact('decorations'));
}
public function music() {
$music = MusicCategory::all();
return view('public.music', compact('music'));
}
}