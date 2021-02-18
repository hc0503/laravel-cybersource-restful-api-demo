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
use File;

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
            if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('activemagazine')) {
                $magazines = Magazine::query()->orderBy('id', 'desc')->get();
            } else {
                $magazines = auth()->user()->magazines()->orderBy('id', 'desc')->get();
            }

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
                ->addColumn('auth', function ($row) {
                    return '<a href="'. route('portal.profiles.show', $row->user->guid) .'" target="_blank"><span class="badge badge-secondary">'. $row->user->email .'</span></a>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status === 1) {
                        return '<span class="badge badge-primary">'. __('global.magazines.field.active') .'</span>';
                    } else {
                        return '<span class="badge badge-warning">'. __('global.magazines.field.inactive') .'</span>';
                    }
                })
                ->editColumn('genre', function ($row) {
                    return $row->genre->name;
                })
                ->editColumn('frequency', function ($row) {
                    return $row->frequency->name;
                })
                ->editColumn('buy_online', function ($row) {
                    return "<a href='$row->buy_online' target='_blank'>$row->buy_online</a>";
                })
                ->rawColumns(['action', 'cover_image', 'status', 'buy_online', 'auth'])
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
            'genre_id' => ['required', 'int'],
            'frequency_id' => ['required', 'int'],
            'cover_image' => ['mimes:jpeg,jpg,png', 'max:2048', 'image'],
            'status' => [],
            'buy_online' => []
        ]);

        if ($request->hasFile('cover_image')) {
            $resizeImage = Image::make($validated['cover_image']->getRealPath())->fit(400, 560);
            $imagePath = '/magazines/covers/'. Str::random(50) .'.'. $validated['cover_image']->getClientOriginalExtension();
            
            if(!is_dir(public_path('storage/magazines/covers'))) {
                mkdir(public_path('storage/magazines/covers'), 0755, true);
            }

            $resizeImage->save(public_path('storage') . $imagePath);
            $validated['cover_image'] = $imagePath;
        }

        $magazine = auth()->user()->magazines()->create($validated);
        
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
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function show($guid)
    {
        $magazine = Magazine::query()->whereGuid($guid)->firstOrFail();
        $genres = Genre::all();
        $frequencies = Frequency::all();
        $pageTitle = __('global.magazines.show');

        return view('portals.magazines.show', compact('pageTitle', 'magazine', 'frequencies', 'genres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function edit($guid)
    {
        $pageTitle = __('global.magazines.edit');
        $genres = Genre::all();
        $frequencies = Frequency::all();
        $magazine = Magazine::query()->whereGuid($guid)->firstOrFail();

        return view('portals.magazines.edit', compact('pageTitle', 'genres', 'frequencies', 'magazine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $guid)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'genre_id' => ['required', 'int'],
            'frequency_id' => ['required', 'int'],
            'cover_image' => ['mimes:jpeg,jpg,png', 'max:2048', 'image'],
            'status' => [],
            'buy_online' => []
        ]);
        
        $magazine = Magazine::query()->whereGuid($guid)->firstOrFail();

        if ($request->hasFile('cover_image')) {
            $imagePath = public_path("/storage/$magazine->cover_image"); // get previous image from folder
            
            if(!is_dir(public_path('storage/magazines/covers'))) {
                mkdir(public_path('storage/magazines/covers'), 0755, true);
            }

            if (File::exists($imagePath) && $magazine->cover_image != null) { // unlink or remove previous image from folder
                unlink($imagePath);
            }

            $resizeImage = Image::make($validated['cover_image']->getRealPath())->fit(400, 560);
            $imagePath = '/magazines/covers/'. Str::random(50) .'.'. $validated['cover_image']->getClientOriginalExtension();
            $resizeImage->save(public_path('storage') . $imagePath);
            $validated['cover_image'] = $imagePath;
        } else {
            if ($request->reset == '1') {
                $imagePath = public_path("/storage/$magazine->cover_image"); // get previous image from folder
                if (File::exists($imagePath) && $magazine->cover_image != null) { // unlink or remove previous image from folder
                    unlink($imagePath);
                }

                $validated['cover_image'] = null;
            }
        }
        $magazine->update($validated);

        return redirect()
            ->route('portal.magazines.index')
            ->with('status', 'success')
            ->with('message', __('global.magazines.message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function destroy($guid)
    {
        $magazine = Magazine::query()->whereGuid($guid)->firstOrFail();
        $imagePath = public_path("/storage/$magazine->cover_image"); // get previous image from folder
        if (File::exists($imagePath) && $magazine->cover_image != null) { // unlink or remove previous image from folder
            unlink($imagePath);
        }
        $magazine->delete();

        return redirect()
            ->route('portal.magazines.index')
            ->with('status', 'success')
            ->with('message', __('global.magazines.message.deleteSuccess'));
    }
}
