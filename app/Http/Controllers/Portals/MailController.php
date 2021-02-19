<?php

namespace App\Http\Controllers\Portals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    protected $fromEmail, $fromTitle, $fromName, $receiveEmail;

    public function __construct()
    {
        $this->fromEmail = config('mail.from.address');
        $this->fromName = config('mail.from.name');
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
        
        $email = $this->receiveEmail;
        $subject = $validated['subject'];

        try {
            Mail::send('portals.emails.template', ['content' => $validated['summernote']], function($message) use ($email, $subject){
                $message->from($this->fromEmail, $this->fromName)
                    ->bcc($email)
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
