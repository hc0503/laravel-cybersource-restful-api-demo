<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use DataTables;
use Storage;
use File;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:createslider', ['only' => ['create']]);
        $this->middleware('permission:editslider',   ['only' => ['edit']]);
        $this->middleware('permission:deleteslider',   ['only' => ['destroy']]);
        $this->middleware('permission:viewslider',   ['only' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.sliders.list');

        if ($request->ajax()) {
            $sliders = Slider::all();

            return DataTables::of($sliders)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->editColumn('status', function ($row) {
                    if ($row->status === 1) {
                        return '<span class="badge badge-primary">'. __('global.magazines.field.active') .'</span>';
                    } else {
                        return '<span class="badge badge-warning">'. __('global.magazines.field.inactive') .'</span>';
                    }
                })
                ->editColumn('url', function ($row) {
                    return "<a href='$row->url' target='_blank'>$row->url</a>";
                })
                ->editColumn('image', function ($row) {
                    return '<img src="'. asset('storage') . $row->image .'" alt="'. $row->title .'" height="100"/>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'. route('portal.sliders.show', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-success btn-sm mb-1 mr-1"><i class="far fa-eye"></i></a>';
                    if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('editgenre')) {
                        $btn .= '<a href="'. route('portal.sliders.edit', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    }
                    if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('deletegenre')) {
                        $btn .= ' <button onclick="deleteData('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                        $btn .= '<form id="deleteForm'. $row->guid .'" action="'. route('portal.sliders.destroy', $row->guid) .'" method="POST" style="display: none">
                        <input type="hidden" name="_token" value="'. csrf_token() .'">
                        <input type="hidden" name="_method" value="DELETE">
                        @method("DELETE")
                        </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['action','status', 'url', 'image'])
                ->make(true);
        }

        return view('portals.sliders.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = __('global.sliders.create');

        return view('portals.sliders.create', compact('pageTitle'));
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
            'image' => ['mimes:jpeg,jpg,png', 'max:2048', 'image'],
            'status' => [],
            'url' => ['url']
        ]);

        if ($request->hasFile('image')) {
            if(!is_dir(public_path('storage/sliders'))) {
                mkdir(public_path('storage/sliders'), 0755, true);
            }

            $validated['image'] = '/' . Storage::disk('public')->put('sliders', $validated['image']);
        }

        Slider::create($validated);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.sliders.index')
                ->with('status', 'success')
                ->with('message', __('global.sliders.message.saveSuccess'));
        else
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', __('global.sliders.message.saveSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function show($guid)
    {
        $slider = Slider::query()->whereGuid($guid)->firstOrFail();
        $pageTitle = __('global.sliders.show');

        return view('portals.sliders.show', compact('pageTitle', 'slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function edit($guid)
    {
        $pageTitle = __('global.sliders.edit');
        $slider = Slider::query()->whereGuid($guid)->firstOrFail();

        return view('portals.sliders.edit', compact('pageTitle', 'slider'));
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
            'image' => ['mimes:jpeg,jpg,png', 'max:2048', 'image'],
            'status' => [],
            'url' => ['url']
        ]);
        
        $slider = Slider::query()->whereGuid($guid)->firstOrFail();
        $imagePath = public_path("/storage/$slider->image"); // get previous image from folder

        if ($request->hasFile('image')) {
            if(!is_dir(public_path('storage/sliders'))) {
                mkdir(public_path('storage/sliders'), 0755, true);
            }

            if (File::exists($imagePath) && $slider->image != null) { // unlink or remove previous image from folder
                unlink($imagePath);
            }

            $validated['image'] = '/' . Storage::disk('public')->put('sliders', $validated['image']);
        } else {
            if ($request->reset == '1') {
                if (File::exists($imagePath) && $slider->image != null) { // unlink or remove previous image from folder
                    unlink($imagePath);
                }

                $validated['image'] = null;
            }
        }
        $slider->update($validated);

        return redirect()
            ->route('portal.sliders.index')
            ->with('status', 'success')
            ->with('message', __('global.sliders.message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function destroy($guid)
    {
        $slider = Slider::query()->whereGuid($guid)->firstOrFail();
        $imagePath = public_path("/storage/$slider->image"); // get previous image from folder
        if (File::exists($imagePath) && $slider->image != null) { // unlink or remove previous image from folder
            unlink($imagePath);
        }
        $slider->delete();

        return redirect()
            ->route('portal.sliders.index')
            ->with('status', 'success')
            ->with('message', __('global.sliders.message.deleteSuccess'));
    }
}
