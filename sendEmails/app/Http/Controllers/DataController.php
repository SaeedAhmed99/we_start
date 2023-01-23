<?php

namespace App\Http\Controllers;

use App\Jobs\SendMails;
use App\Mail\SendMail;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DataController extends Controller
{
    public function send()
    {
        $mails = Data::select('email')->get();

        foreach ($mails as $mail) {
            // Mail::to($mail)->send(new SendMail);
            Mail::to($mail)->queue(new SendMail);
        }

        // Data::chunk(10, function($data) {
        //     dispatch(new SendMails($data));
        // });
        return 'will send in background can do any other things';
    }
}
