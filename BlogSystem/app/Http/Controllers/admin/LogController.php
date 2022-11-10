<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index(Request $request) {
        $count = 10;
        if($request->has('count')) {
            $count = $request->count;
        }

        if($request->has('search')) {
            $logs = log::where('action', 'like', '%'.$request->search.'%')->latest()->paginate($count);
        }
        $logs = Log::latest()->paginate($count);

        return view('admin.general.logs', compact('logs'));
    }
}
