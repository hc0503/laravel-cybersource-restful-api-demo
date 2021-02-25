<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disclaimer;

class DisclaimerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:editdisclaimer',   ['only' => ['updateDisclaimer']]);
        $this->middleware('permission:viewdisclaimer',   ['only' => ['ShowDisclaimer']]);
    }

    public function getDisclaimer()
    {
        $pageTitle = __('global.termsAndConditions.title');
        $disclaimer = Disclaimer::first();

        return view('disclaimers.disclaimer', compact('pageTitle', 'disclaimer'));
    }

    public function ShowDisclaimer()
    {
        $pageTitle = __('global.termsAndConditions.title');
        $disclaimer = Disclaimer::first();

        return view('disclaimers.show', compact('pageTitle', 'disclaimer'));
    }

    public function updateDisclaimer(Request $request, $guid)
    {
        $validated = $request->validate([
            'content' => ['required']
        ]);

        $disclaimer = Disclaimer::updateOrCreate([
            'guid' => $guid,
        ], $validated);

        return redirect()
            ->route('portal.disclaimers.show')
            ->with('status', 'success')
            ->with('message', __('global.termsAndConditions.message.updateSuccess'));
    }
}
