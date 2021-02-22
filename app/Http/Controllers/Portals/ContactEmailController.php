<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactEmail;
use Carbon\Carbon;
use DataTables;

class ContactEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:createcontactemail', ['only' => ['create']]);
        $this->middleware('permission:editcontactemail',   ['only' => ['edit']]);
        $this->middleware('permission:deletecontactemail',   ['only' => ['destroy']]);
        $this->middleware('permission:viewcontactemail',   ['only' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = __('global.contactEmails.list');
        if ($request->ajax()) {
            $contactEmails = ContactEmail::all();

            return DataTables::of($contactEmails)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->editColumn('email', function ($row) {
                    return "<a href='mailto:$row->email' target='__blank'>$row->email</a>";
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('editcontactemail')) {
                        $btn .= '<a href="'. route('portal.contact-emails.edit', $row->guid) .'" data-id="'.$row->guid.'" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    }
                    if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasPermissionTo('deletecontactemail')) {
                        $btn .= ' <button onclick="deleteData('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                        $btn .= '<form id="deleteForm'. $row->guid .'" action="'. route('portal.contact-emails.destroy', $row->guid) .'" method="POST" style="display: none">
                        <input type="hidden" name="_token" value="'. csrf_token() .'">
                        <input type="hidden" name="_method" value="DELETE">
                        @method("DELETE")
                        </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['action', 'email'])
                ->make(true);
        }

        return view('portals.contactemails.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = __('global.contactEmails.create');

        return view('portals.contactemails.create', compact('pageTitle'));
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
            'email' => ['required', 'string', 'email', 'unique:contact_emails', 'max:255']
        ]);

        $contactEmail = ContactEmail::create($validated);
        
        if ($request->exit === 'true')
            return redirect()
                ->route('portal.contact-emails.index')
                ->with('status', 'success')
                ->with('message', __('global.contactEmails.message.saveSuccess'));
        else
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', __('global.contactEmails.message.saveSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function show($guid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function edit($guid)
    {
        $contactEmail = ContactEmail::query()->whereGuid($guid)->firstOrFail();
        $pageTitle = __('global.contactEmails.edit');

        return view('portals.contactemails.edit', compact('pageTitle', 'contactEmail'));
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
        $contactEmail = ContactEmail::query()->whereGuid($guid)->firstOrFail();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:contact_emails,email,'.$contactEmail->id, 'max:255']
        ]);

        $contactEmail->update($validated);

        return redirect()
            ->route('portal.contact-emails.index')
            ->with('status', 'success')
            ->with('message', __('global.contactEmails.message.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function destroy($guid)
    {
        $contactEmail = ContactEmail::query()->whereGuid($guid)->firstOrFail();
        $contactEmail->delete();

        return redirect()
            ->route('portal.contact-emails.index')
            ->with('status', 'success')
            ->with('message', __('global.contactEmails.message.deleteSuccess'));
    }
}
