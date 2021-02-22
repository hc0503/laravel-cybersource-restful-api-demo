<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use PragmaRX\Countries\Package\Countries;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:createuser', ['only' => ['create']]);
        $this->middleware('permission:edituser',   ['only' => ['edit']]);
        $this->middleware('permission:deleteuser',   ['only' => ['destroy']]);
        $this->middleware('permission:viewuser',   ['only' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.users.list');

        if ($request->ajax()) {
            $users = User::all();

            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->editColumn('website', function ($row) {
                    return "<a href='$row->website' target='_blank'>$row->website</a>";
                })
                ->addColumn('roles', function ($row) {
                    $roles = '';
                    foreach ($row->roles as $role) {
                        $roles .= '<span class="badge badge-secondary mr-1">'. $role->name .'</span>';
                    }

                    return $roles;
                })
                ->addColumn('action', function ($row) {
                    if (request()->user()->id === $row->id)
                        $disabled = 'disabled';
                    else
                        $disabled = '';

                    $btn = '<a href="'. route('portal.usermanage.users.login', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-info btn-sm mb-1 mr-1"><i class="fas fa-user-lock"></i></a>';
                    $btn .= '<a href="'. route('portal.usermanage.users.show', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-success btn-sm mb-1 mr-1"><i class="far fa-eye"></i></a>';
                    if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('edituser')) {
                        $btn .= '<a href="'. route('portal.usermanage.users.edit', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    }
                    if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('deleteuser')) {
                        $btn .= ' <button onclick="deleteUser('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1" '. $disabled .'><i class="far fa-trash-alt"></i></button>';
                        $btn .= '<form id="deleteForm'. $row->guid .'" action="'. route('portal.usermanage.users.destroy', $row->guid) .'" method="POST" style="display: none">
                        <input type="hidden" name="_token" value="'. csrf_token() .'">
                        <input type="hidden" name="_method" value="DELETE">
                        @method("DELETE")
                        </form>';
                    }

                    return $btn;
                })
                ->editColumn('country', function ($row) {
                    return Countries::where('cca2', $row->country)->first()->name->common;
                })
                ->rawColumns(['website', 'roles', 'action'])
                ->make(true);
        }

        return view('portals.users.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::query()->orderBy('id', 'desc')->get();
        $countries = Countries::all()
            ->map(function ($country) {
                return [
                    'code' => $country->cca2,
                    'name' => $country->name->common
                ];
            })
            ->values();
        $pageTitle = __('global.users.create');

        return view('portals.users.create', compact('roles', 'pageTitle', 'countries'));
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
            'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
            'company' => [],
            'website' => ['url'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required']
        ]);

        $user = User::create($validated);
        $user->assignRole($validated['roles']);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.usermanage.users.index')
                ->with('status', 'success')
                ->with('message', __('global.users.message.saveSuccess'));
        else
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', __('global.users.message.saveSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($guid)
    {
        $user = User::query()->whereGuid($guid)->firstOrFail();
        $countries = Countries::all()
            ->map(function ($country) {
                return [
                    'code' => $country->cca2,
                    'name' => $country->name->common
                ];
            })
            ->values();
        $pageTitle = __('global.users.show');
        $roles = Role::all();

        return view('portals.users.show', compact('pageTitle', 'user', 'roles', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $guid
     * @return \Illuminate\Http\Response
     */
    public function edit($guid)
    {
        $user = User::query()->whereGuid($guid)->firstOrFail();
        $roles = Role::query()->orderBy('id', 'desc')->get();
        $countries = Countries::all()
            ->map(function ($country) {
                return [
                    'code' => $country->cca2,
                    'name' => $country->name->common
                ];
            })
            ->values();
        $pageTitle = __('global.users.edit');

        return view('portals.users.edit', compact('user', 'pageTitle', 'countries', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $guid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $guid)
    {
        $user = User::query()->whereGuid($guid)->firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email,'.$user->id, 'max:255'],
            'company' => [],
            'website' => ['url'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
            'roles' => ['required']
        ]);

        $user->update($validated);
        $user->syncRoles($validated['roles']);

        return redirect()
            ->route('portal.usermanage.users.index')
            ->with('status', 'success')
            ->with('message', __('global.users.message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $guid
     * @return \Illuminate\Http\Response
     */
    public function destroy($guid)
    {
        $user = User::query()->whereGuid($guid)->firstOrFail();
        $user->delete();

        return redirect()
            ->route('portal.usermanage.users.index')
            ->with('status', 'success')
            ->with('message', __('global.users.message.deleteSuccess'));
    }

    /**
     * Login using user ID to another user.
     * 
     * @param  string $guid
     * @return \Illuminate\Http\Response
     */
    public function loginUsingId($guid)
    {
        $me = User::query()->whereGuid(session()->get('me'))->firstOrFail();
        $user = User::query()->whereGuid($guid)->firstOrFail();
        if (!$me->hasPermissionTo('managelogin') || !$me->hasRole('SuperAdmin'))
            abort(403);

        auth()->loginUsingId($user->id);

        return redirect()
            ->route('portal.home')
            ->with('status', 'success')
            ->with('message', 'You have logined to '. $user->email);
    }
}
