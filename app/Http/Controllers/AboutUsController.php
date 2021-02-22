<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $pageTitle = __('global.aboutUs.title');
        
        return view('about-us', compact('pageTitle'));
    }
}
