<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Magazine;
use App\Models\Genre;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $sliders = Slider::query()->where('status', 1)->get();
        if ($request->genre && $request->genre != 'all') {
            $currentGenre = $request->genre; 
            $genre = Genre::query()->whereGuid($request->genre)->firstOrFail();
            $magazines = $genre->magazines()->where('status', 1)->paginate(20);
        } else {
            $currentGenre = 'all';
            $magazines = Magazine::query()->where('status', 1)->paginate(20);
        }
        $pageTitle = __('global.home.title');
        $genres = Genre::all();

        return view('home', compact('sliders', 'magazines', 'pageTitle', 'genres', 'currentGenre'));
    }

    public function getDetails($guid)
    {
        $magazine = Magazine::query()->whereGuid($guid)->firstOrFail();
        $pageTitle = __('global.home.magazineDetails');

        return view('details', compact('magazine', 'pageTitle'));
    }
}
