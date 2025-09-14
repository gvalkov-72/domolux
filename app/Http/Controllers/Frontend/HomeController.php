<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Section;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Section::with(['items' => function ($q) {
            $q->where('is_active', 1)->orderBy('position');
        }])
        ->where('is_active', 1)
        ->orderBy('position')
        ->get();

        return view('frontend.EstateAgency.index', compact('sections'));
    }
}
