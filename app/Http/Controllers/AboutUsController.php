<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:editaboutus',   ['only' => ['updateAboutUs']]);
        $this->middleware('permission:viewaboutus',   ['only' => ['ShowAboutUs']]);
    }

    public function index()
    {
        $pageTitle = __('global.aboutUs.footTitle');
        $aboutUs = AboutUs::first();

        return view('aboutus.about-us', compact('pageTitle', 'aboutUs'));
    }

    public function ShowAboutUs()
    {
        $pageTitle = __('global.aboutUs.footTitle');
        $aboutUs = AboutUs::first();

        return view('aboutus.show', compact('pageTitle', 'aboutUs'));
    }

    public function updateAboutUs(Request $request, $guid)
    {
        $validated = $request->validate([
            'content' => ['required']
        ]);

        $aboutUs = AboutUs::updateOrCreate([
            'guid' => $guid,
        ], $validated);

        return redirect()
            ->route('portal.aboutus.show')
            ->with('status', 'success')
            ->with('message', __('global.aboutUs.message.updateSuccess'));
    }
}
