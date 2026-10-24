<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the POS application landing page.
     */
    public function home(): View
    {
        return view('pages.home', [
            'title'      => 'Home | POS Eloquent',
            'activePage' => 'home',
        ]);
    }

    /**
     * Display the MVC architecture and request flow documentation page.
     */
    public function about(): View
    {
        return view('pages.about', [
            'title'      => 'About | POS Eloquent',
            'activePage' => 'about',
        ]);
    }
}
