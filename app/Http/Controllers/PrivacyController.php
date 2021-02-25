<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Privacy;

class PrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:editprivacy',   ['only' => ['updatePrivacy']]);
        $this->middleware('permission:viewprivacy',   ['only' => ['ShowPrivacy']]);
    }

    public function getPrivacy()
    {
        $pageTitle = __('global.privacyPolicy.title');
        $privacy = Privacy::first();

        return view('privacies.privacy', compact('pageTitle', 'privacy'));
    }

    public function ShowPrivacy()
    {
        $pageTitle = __('global.privacyPolicy.title');
        $privacy = Privacy::first();

        return view('privacies.show', compact('pageTitle', 'privacy'));
    }

    public function updatePrivacy(Request $request, $guid)
    {
        $validated = $request->validate([
            'content' => ['required']
        ]);

        $privacy = Privacy::updateOrCreate([
            'guid' => $guid,
        ], $validated);

        return redirect()
            ->route('portal.privacies.show')
            ->with('status', 'success')
            ->with('message', __('global.privacyPolicy.message.updateSuccess'));
    }
}
