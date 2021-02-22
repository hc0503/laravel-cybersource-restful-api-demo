<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    protected $receiveEmail;

    public function __construct()
    {
        $this->receiveEmail = config('mail.to');
    }

    public function getContactUs()
    {
        $pageTitle = __('aboutUs');
        $countries = Countries::all()
            ->map(function ($country) {
                return [
                    'code' => $country->cca2,
                    'name' => $country->name->common
                ];
            })
            ->values();

        return view('contact-us.view', compact('pageTitle', 'countries'));
    }

    public function postContactUs(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'company' => [],
            'country' => ['required'],
            'telephone' => ['required'],
            'website' => [],
            'email' => ['required', 'email'],
            'enquiry' => ['required'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ]);

        $receiveEmail = $this->receiveEmail;
        $subject = 'Contact Us of ' . config('app.name');

        try {
            Mail::send('contact-us.template',
                $validated,
                function ($message) use ($receiveEmail, $subject, $validated) {
                    $message->from($validated['email'], $validated['name'])
                        ->bcc($receiveEmail)
                        ->subject($subject);
                }
            );
        } catch (Exception $exception) {
            return redirect()->route('contact-us.view')
                ->with('status', 'danger')
                ->with('message', $exception->getMessage());

        }

        return redirect()->route('contact-us.view')
            ->with('status', 'success')
            ->with('message', __('global.contactUs.message.sendSuccess'));
    }
}
