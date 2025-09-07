<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        $pages = Page::whereIn('slug', ['hero', 'services', 'agents', 'testimonials'])
                     ->where('is_active', true)
                     ->get()
                     ->keyBy('slug');

        return view('frontend.EstateAgency.index', compact('pages'));
    }
}
