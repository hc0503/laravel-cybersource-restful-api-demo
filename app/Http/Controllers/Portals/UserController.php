<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.users.list');

        if ($request->ajax()) {
            $users = User::all();

            return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->editColumn('website', function ($row) {
                    return "<a href='$row->website' target='_blank'>$row->website</a>";
                })
                ->addColumn('action', function ($row) {
                    if (request()->user()->id === $row->id)
                        $disabled = 'disabled';
                    else
                        $disabled = '';

                    $btn = '<a href="'. route('portal.users.edit', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-primary btn-sm mb-1"><i class="fas fa-edit"></i></a>';
                    $btn .= ' <button onclick="deleteUser('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1" '. $disabled .'><i class="fas fa-trash"></i></button>';
                    $btn .= '<form id="deleteForm'. $row->guid .'" action="'. route('portal.users.destroy', $row->guid) .'" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    @method("DELETE")
                    </form>';

                    return $btn;
                })
                ->rawColumns(['website', 'action'])
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
        $pageTitle = __('global.users.create');

        return view('portals.users.create', compact('roles', 'pageTitle'));
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
            'website' => [],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::create($validated);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.users.index')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $guid
     * @return \Illuminate\Http\Response
     */
    public function edit($guid)
    {
        $user = User::query()->whereGuid($guid)->first();
        $pageTitle = __('global.users.edit');

        return view('portals.users.edit', compact('user', 'pageTitle'));
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
        $user = User::query()->whereGuid($guid)->first();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email,'.$user->id, 'max:255'],
            'company' => [],
            'website' => [],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'password' => ['string', 'min:8', 'confirmed', 'nullable']
        ]);

        $user->update($validated);

        return redirect()
            ->route('portals.users.index')
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
        //
    }
}
