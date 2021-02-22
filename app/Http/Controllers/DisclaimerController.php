<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisclaimerController extends Controller
{
    public function getDisclaimer()
    {
        $pageTitle = __('global.termsAndConditions.title');

        return view('disclaimer', compact('pageTitle'));
    }
}
