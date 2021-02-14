<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Genre;
use DataTables;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:creategenre', ['only' => ['create']]);
        $this->middleware('permission:editgenre',   ['only' => ['edit']]);
        $this->middleware('permission:deletegenre',   ['only' => ['destroy']]);
        $this->middleware('permission:viewgenre',   ['only' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.genres.list');

        if ($request->ajax()) {
            $genres = Genre::all();

            return DataTables::of($genres)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'. route('portal.genres.show', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-success btn-sm mb-1 mr-1"><i class="far fa-eye"></i></a>';
                    $btn .= '<a href="'. route('portal.genres.edit', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    $btn .= ' <button onclick="deleteData('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                    $btn .= '<form id="deleteForm'. $row->guid .'" action="'. route('portal.genres.destroy', $row->guid) .'" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    @method("DELETE")
                    </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('portals.genres.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = __('global.genres.create');

        return view('portals.genres.create', compact('pageTitle'));
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
            'name' => ['required', 'string', 'unique:permissions', 'max:255'],
        ]);

        $genre = Genre::create($validated);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.genres.index')
                ->with('status', 'success')
                ->with('message', __('global.genres.message.saveSuccess'));
        else
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', __('global.genres.message.saveSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function show($guid)
    {
        $genre = Genre::query()->whereGuid($guid)->firstOrFail();
        $pageTitle = __('global.genres.show');

        return view('portals.genres.show', compact('pageTitle', 'genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function edit($guid)
    {
        $genre = Genre::query()->whereGuid($guid)->firstOrFail();
        $pageTitle = __('global.genres.edit');

        return view('portals.genres.edit', compact('pageTitle', 'genre'));
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
        $genre = Genre::query()->whereGuid($guid)->firstOrFail();
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:genres,name,'.$genre->id, 'max:255'],
        ]);

        $genre->update($validated);

        return redirect()
            ->route('portal.genres.index')
            ->with('status', 'success')
            ->with('message', __('global.genres.message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function destroy($guid)
    {
        $genre = Genre::query()->whereGuid($guid)->firstOrFail();
        $genre->delete();

        return redirect()
            ->route('portal.genres.index')
            ->with('status', 'success')
            ->with('message', __('global.genres.message.deleteSuccess'));
    }
}
