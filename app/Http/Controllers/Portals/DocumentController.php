<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Document;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Storage;
use File;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:createdocument', ['only' => ['create']]);
        $this->middleware('permission:editdocument',   ['only' => ['edit']]);
        $this->middleware('permission:deletedocument',   ['only' => ['destroy']]);
        // $this->middleware('permission:viewdocument',   ['only' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.documents.list');

        if ($request->ajax()) {
            if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('activemagazine')) {
                $documents = Document::query()->orderBy('id', 'desc')->get();
            } else {
                $documents = auth()->user()->documents()->orderBy('id', 'desc')->get();
            }

            return DataTables::of($documents)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'. route('portal.documents.show', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-success btn-sm mb-1 mr-1"><i class="far fa-eye"></i></a>';
                    $btn .= '<a href="'. asset('storage') . $row->path .'" class="btn btn-info btn-sm mb-1 mr-1" target="__blank"><i class="fas fa-download"></i></a>';
                    if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('editdocument')) {
                        $btn .= '<a href="'. route('portal.documents.edit', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    }
                    if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('deletedocument')) {
                        $btn .= ' <button onclick="deleteData('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                        $btn .= '<form id="deleteForm'. $row->guid .'" action="'. route('portal.documents.destroy', $row->guid) .'" method="POST" style="display: none">
                        <input type="hidden" name="_token" value="'. csrf_token() .'">
                        <input type="hidden" name="_method" value="DELETE">
                        @method("DELETE")
                        </form>';
                    }

                    return $btn;
                })
                ->addColumn('users', function ($row) {
                    $users = '';
                    foreach ($row->users as $user) {
                        $users .= '<a href="'. route('portal.profiles.show', $user->guid) .'" target="_blank"><span class="badge badge-secondary mr-1">'. $user->email .'</span></a>';
                    }

                    return $users;
                })
                ->rawColumns(['action', 'users'])
                ->make(true);
        }
        return view('portals.documents.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = __('global.documents.create');
        $users = User::all();

        return view('portals.documents.create', compact('pageTitle', 'users'));
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
            'name' => ['required', 'string', 'max:255'],
            'document' => ['mimes:pdf,xlsx,xls,csv', 'max:2048', 'file', 'required'],
            'users' => ['required', 'array']
        ]);

        if ($request->hasFile('document')) {
            if(!is_dir(public_path('storage/documents'))) {
                mkdir(public_path('storage/documents'), 0755, true);
            }

            $validated['path'] = '/' . Storage::disk('public')->put('documents', $validated['document']);
        }
        $document = Document::create($validated);
        $document->users()->attach($validated['users']);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.documents.index')
                ->with('status', 'success')
                ->with('message', __('global.documents.message.saveSuccess'));
        else
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', __('global.documents.message.saveSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function show($guid)
    {
        $document = Document::query()->whereGuid($guid)->firstOrFail();
        $users = User::all();
        $pageTitle = __('global.documents.show');

        return view('portals.documents.show', compact('pageTitle', 'document', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function edit($guid)
    {
        $document = Document::query()->whereGuid($guid)->firstOrFail();
        $users = User::all();
        $pageTitle = __('global.documents.edit');

        return view('portals.documents.edit', compact('pageTitle', 'document', 'users'));
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
            'name' => ['required', 'string', 'max:255'],
            'document' => ['mimes:pdf,xlsx,xls,csv', 'max:2048', 'file'],
            'users' => ['required', 'array']
        ]);
        
        $document = Document::query()->whereGuid($guid)->firstOrFail();

        if ($request->hasFile('document')) {
            $filePath = public_path("/storage/$document->path"); // get previous file from folder
            
            if(!is_dir(public_path('storage/documents'))) {
                mkdir(public_path('storage/documents'), 0755, true);
            }

            if (File::exists($filePath) && $document->path != null) { // unlink or remove previous image from folder
                unlink($filePath);
            }
            
            $validated['path'] = '/' . Storage::disk('public')->put('documents', $validated['document']);

        }

        $document->update($validated);
        $document->users()->sync($validated['users']);

        return redirect()
            ->route('portal.documents.index')
            ->with('status', 'success')
            ->with('message', __('global.documents.message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function destroy($guid)
    {
        $document = Document::query()->whereGuid($guid)->firstOrFail();
        $file = public_path('storage') . $document->path; // get previous file from folder
        if (File::exists($file) && $document->path != null) { // unlink or remove previous image from folder
            unlink($file);
        }
        $document->delete();

        return redirect()
            ->route('portal.documents.index')
            ->with('status', 'success')
            ->with('message', __('global.documents.message.deleteSuccess'));
    }
}
