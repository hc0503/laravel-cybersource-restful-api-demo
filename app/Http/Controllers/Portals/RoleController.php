<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:createrole', ['only' => ['create']]);
        $this->middleware('permission:editrole',   ['only' => ['edit']]);
        $this->middleware('permission:deleterole',   ['only' => ['destroy']]);
        $this->middleware('permission:viewrole',   ['only' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.roles.list');

        if ($request->ajax()) {
            $roles = Role::all();

            return Datatables::of($roles)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'. route('portal.usermanage.roles.show', $row->id) .'" data-id="'.$row->id.'" class="btn btn-success btn-sm mb-1 mr-1"><i class="far fa-eye"></i></a>';
                    $btn .= '<a href="'. route('portal.usermanage.roles.edit', $row->id) .'" data-id="'.$row->id.'" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    $btn .= ' <button onclick="deleteUser('. "'$row->id'" .')" data-id="'.$row->id.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                    $btn .= '<form id="deleteForm'. $row->id .'" action="'. route('portal.usermanage.roles.destroy', $row->id) .'" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    @method("DELETE")
                    </form>';

                    return $btn;
                })
                ->addColumn('permissions', function ($row) {
                    $permissions = '';
                    foreach ($row->permissions as $permission) {
                        $permissions .= '<span class="badge badge-secondary mr-1">'. $permission->name .'</span>';
                    }

                    return $permissions;
                })
                ->rawColumns(['action', 'permissions'])
                ->make(true);
        }

        return view('portals.roles.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = __('global.roles.create');
        $permissions = Permission::all();

        return view('portals.roles.create', compact('pageTitle', 'permissions'));
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
            'name' => ['required', 'string', 'unique:roles', 'max:255'],
            'permissions' => ['required'],
        ]);

        $role = Role::create($validated);
        $role->givePermissionTo($validated['permissions']);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.usermanage.roles.index')
                ->with('status', 'success')
                ->with('message', __('global.roles.message.saveSuccess'));
        else
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', __('global.roles.message.saveSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        $pageTitle = __('global.roles.show');
        $permissions = Permission::all();

        return view('portals.roles.show', compact('pageTitle', 'role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $pageTitle = __('global.roles.edit');
        $permissions = Permission::all();

        return view('portals.roles.edit', compact('pageTitle', 'permissions', 'role'));
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
            'name' => ['required', 'string', 'unique:roles,name,'.$id, 'max:255'],
            'permissions' => ['required'],
        ]);

        $role = Role::findOrFail($id);
        $role->update($validated);
        $role->syncPermissions($validated['permissions']);

        return redirect()
            ->route('portal.usermanage.roles.index')
            ->with('status', 'success')
            ->with('message', __('global.roles.message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()
            ->route('portal.usermanage.roles.index')
            ->with('status', 'success')
            ->with('message', __('global.roles.message.deleteSuccess'));
    }
}
