<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotifyController extends Controller
{
    public function send()
    {
        $res = Http::get('http://hotsms.ps/sendbulksms.php', [
            'user_name' => 'test7',
            'user_pass' => '8727591',
            'sender' => 'test',
            'mobile' => '0592670634',
            'type' => 2,
            'text' => 'Welcome From We Start جديد $'
        ]);
        dd($res->body());
    }
}
