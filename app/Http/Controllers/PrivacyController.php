<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function getPrivacy()
    {
        $pageTitle = __('global.privacyPolicy.title');

        return view('privacy', compact('pageTitle'));
    }
}
