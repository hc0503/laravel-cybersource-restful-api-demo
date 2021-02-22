<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    protected $receiveEmail;

    public function __construct()
    {
        $this->receiveEmail = config('mail.to');
    }

    /**
     * Show the compose for sending email.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCompose()
    {
        $pageTitle = __('global.emails.emailUs');

        return view('portals.emails.compose', compact('pageTitle'));
    }

    /**
     * Send email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'summernote' => ['required']
        ]);
        
        $receiveEmail = $this->receiveEmail;
        $subject = $validated['subject'];
        $fromEmail = $request->user()->email;
        $fromName = $request->user()->name;

        try {
            Mail::send('portals.emails.template', ['content' => $validated['summernote']], function ($message) use ($email, $subject) {
                $message->from($fromEmail, $fromName)
                    ->bcc($receiveEmail)
                    ->subject($subject);
            });
        } catch (Exception $exception) {
            return redirect()->route('portal.emails.compose')
                ->with('status', 'danger')
                ->with('message', $exception->getMessage());

        }

        return redirect()->route('portal.emails.compose')
            ->with('status', 'success')
            ->with('message', __('global.emails.message.sendSuccess'));
    }
}
