<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();
        $settings = SiteSetting::current();

        return view('pages.show', compact('page', 'settings'));
    }

    public function staff()
    {
        $settings = SiteSetting::current();
        $landingPage = Page::published()->where('slug', 'staff-akademik')->first();
        $staff = \App\Models\Staff::query()->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();

        return view('pages.staff', compact('settings', 'staff', 'landingPage'));
    }
}
