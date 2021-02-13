<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use PragmaRX\Countries\Package\Countries;

class ProfileController extends Controller
{
    /**
     * 
     */
    public function show($guid)
    {
        $user = User::query()->whereGuid($guid)->firstOrFail();
        $pageTitle = __('global.profiles.title');
        $countries = Countries::all()
        ->map(function ($country) {
            return [
                'code' => $country->cca2,
                'name' => $country->name->common
            ];
        })
        ->values();

        return view('portals.profiles.show', compact('pageTitle', 'user', 'countries'));
    }

    /**
     * 
     */
    public function edit($guid)
    {
        $user = User::query()->whereGuid($guid)->firstOrFail();
        $pageTitle = __('global.profiles.edit');
        $countries = Countries::all()
        ->map(function ($country) {
            return [
                'code' => $country->cca2,
                'name' => $country->name->common
            ];
        })
        ->values();

        return view('portals.profiles.edit', compact('pageTitle', 'user', 'countries'));
    }

    /**
     * 
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
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
        ]);

        $user->update($validated);

        return redirect()
            ->route('portal.profiles.show', $guid)
            ->with('status', 'success')
            ->with('message', __('global.profiles.message.updateSuccess'));
    }
}
