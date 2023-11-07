<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;
use App\Models\RegisteredGuestMessageReply;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Mail;
use App\Mail\SendReply;

class MailController extends Controller
{
    public function sendReply(Request $request)
    {
        $eventId = $request->event_id;

        $name = $request->name;
        $email =$request->email;
        $subject = $request->subject;
        $message = $request->message_body;
        $title = $request->title;

        $replied_by = 1;
        $replied_at = Carbon::now();

        $target = new RegisteredGuestMessageReply;

        $target->event_id = $request->event_id;
        $target->name = $name;
        $target->email = $email;
        $target->subject = $subject;
        $target->message_body = $message;
        $target->title = $title;
        $target->replied_by = $replied_by;
        $target->replied_at = $replied_at;

        $target->save();

        $data = [
            'subject' => $subject,
            'name' => $name,
            'title' => $title,
            'body' => $message,
        ];


        Mail::to($email)->send(new SendReply($data));

        if (Mail::failures()) {
            return 'Sorry! Please try again.';
        } else {
            return 'Great! Your message has been successfully sent.';
        }
    }
}
