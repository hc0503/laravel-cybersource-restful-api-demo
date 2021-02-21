<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $pageTitle = __('aboutUs');
        
        return view('gallery', compact('pageTitle'));
    }
}
