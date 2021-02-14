<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:createpermission', ['only' => ['create']]);
        $this->middleware('permission:editpermission',   ['only' => ['edit']]);
        $this->middleware('permission:deletepermission',   ['only' => ['destroy']]);
        $this->middleware('permission:viewpermission',   ['only' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.permissions.list');

        if ($request->ajax()) {
            $permissions = Permission::all();

            return DataTables::of($permissions)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'. route('portal.usermanage.permissions.show', $row->id) .'" data-id="'.$row->id.'" class="btn btn-success btn-sm mb-1 mr-1"><i class="far fa-eye"></i></a>';
                    $btn .= '<a href="'. route('portal.usermanage.permissions.edit', $row->id) .'" data-id="'.$row->id.'" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    $btn .= ' <button onclick="deleteUser('. "'$row->id'" .')" data-id="'.$row->id.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                    $btn .= '<form id="deleteForm'. $row->id .'" action="'. route('portal.usermanage.permissions.destroy', $row->id) .'" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    @method("DELETE")
                    </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('portals.permissions.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = __('global.permissions.create');

        return view('portals.permissions.create', compact('pageTitle'));
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

        $permission = Permission::create($validated);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.usermanage.permissions.index')
                ->with('status', 'success')
                ->with('message', __('global.permissions.message.saveSuccess'));
        else
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', __('global.permissions.message.saveSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        $pageTitle = __('global.permissions.show');

        return view('portals.permissions.show', compact('pageTitle', 'permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $pageTitle = __('global.permissions.edit');

        return view('portals.permissions.edit', compact('pageTitle', 'permission'));
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name,'.$id, 'max:255'],
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update($validated);

        return redirect()
            ->route('portal.usermanage.permissions.index')
            ->with('status', 'success')
            ->with('message', __('global.permissions.message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()
            ->route('portal.usermanage.permissions.index')
            ->with('status', 'success')
            ->with('message', __('global.permissions.message.deleteSuccess'));
    }
}
