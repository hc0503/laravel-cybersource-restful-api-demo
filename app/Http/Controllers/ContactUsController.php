<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    protected $fromEmail, $fromTitle, $fromName, $receiveEmail;

    public function __construct()
    {
        $this->fromEmail = config('mail.from.address');
        $this->fromName = config('mail.from.name');
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

        dd('OK');

        $email = $this->receiveEmail;
        $subject = $validated['subject'];

        try {
            Mail::send('contact-us.template',
                [
                    'name' => $validated['name'],
                    'company' => $validated['company'],
                    'country' => $validated['country'],
                    'telephone' => $validated['telephone'],
                    'website' => $validated['website'],
                    'email' => $validated['email'],
                    'enquiry' => $validated['enquiry']
                ],
                function ($message) use ($email, $subject) {
                    $message->from($this->fromEmail, $this->fromName)
                        ->bcc($email)
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
