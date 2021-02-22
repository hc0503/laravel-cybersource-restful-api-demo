<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    protected $receiveEmail, $fromEmail, $fromName;

    public function __construct()
    {
        $this->receiveEmail = config('mail.to');
        $this->fromEmail = config('mail.from.address');
        $this->fromName = config('app.name');
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
        $fromEmail = $this->fromEmail;
        $fromName = $this->fromName;
        $subject = 'Contact Us of ' . config('app.name');
        $validated['country'] = Countries::where('cca2', $validated['country'])->first()->name->common;

        try {
            Mail::send('contact-us.template',
                $validated,
                function ($message) use ($receiveEmail, $subject, $fromEmail, $fromName) {
                    $message->from($fromEmail, $fromName)
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
