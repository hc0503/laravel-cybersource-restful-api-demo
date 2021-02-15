<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Models\Magazine;
use App\Models\Genre;
use App\Models\Frequency;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Str;

class MagazineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.magazines.list');

        if ($request->ajax()) {
            $magazines = Magazine::all();

            return DataTables::of($magazines)
                ->addIndexColumn()
                ->editColumn('cover_image', function ($row) {
                    return '<img src="'. asset('storage') . $row->cover_image .'" alt="'. $row->title .'" height="100"/>';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'. route('portal.magazines.show', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-success btn-sm mb-1 mr-1"><i class="far fa-eye"></i></a>';
                    $btn .= '<a href="'. route('portal.magazines.edit', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    $btn .= ' <button onclick="deleteData('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                    $btn .= '<form id="deleteForm'. $row->guid .'" action="'. route('portal.magazines.destroy', $row->guid) .'" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    @method("DELETE")
                    </form>';

                    return $btn;
                })
                ->editColumn('genre', function ($row) {
                    return $row->genre->name;
                })
                ->editColumn('frequency', function ($row) {
                    return $row->frequency->name;
                })
                ->rawColumns(['action', 'cover_image'])
                ->make(true);
        }

        return view('portals.magazines.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = __('global.magazines.create');
        $genres = Genre::all();
        $frequencies = Frequency::all();

        return view('portals.magazines.create', compact('pageTitle', 'genres', 'frequencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'genre' => ['required', 'int'],
            'frequency' => ['required', 'int'],
            'cover_image' => ['mimes:jpeg,jpg,png', 'max:2048', 'image']
        ]);

        $validated['genre_id'] = $validated['genre'];
        $validated['frequency_id'] = $validated['frequency'];
        if ($request->file('cover_image')) {
            $resizeImage = Image::make($validated['cover_image']->getRealPath())->fit(400, 560);
            $imagePath = '/magazines/covers'. Str::random(50) .'.'. $validated['cover_image']->getClientOriginalExtension();
            $resizeImage->save(public_path('storage') . $imagePath);
            $validated['cover_image'] = $imagePath;
        }

        $magazine = Magazine::create($validated);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.magazines.index')
                ->with('status', 'success')
                ->with('message', __('global.magazines.message.saveSuccess'));
        else
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', __('global.magazines.message.saveSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
