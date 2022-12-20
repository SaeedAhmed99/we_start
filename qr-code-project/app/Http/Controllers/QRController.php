<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Color\Hex;

class QRController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function do_qr_code_builder(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'body' => 'required'
        ]);

        $name = $request->name;
        $body = $request->body;
        $qr_size = $request->qr_size ?? '300';
        $qr_img_type = $request->qr_img_type ?? 'png';
        $qr_correction = $request->qr_correction ?? 'H';
        $qr_encoding = $request->qr_encoding ?? 'UTF-8';
        $eye = $request->qr_eye ?? 'square';
        $qr_margin = $request->qr_margin ?? '5';
        $qr_style = $request->qr_style ?? 'square';
        $qr_color = Hex::fromString($request->qr_color ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_background_color = Hex::fromString($request->qr_background_color ?? '#ffffff')->toRgb() ?? 'rgb(255,255,255)';
        $qr_background_trancparent = $request->qr_background_trancparent ?? '0';
        $qr_eye_color_ineer_0 = Hex::fromString($request->qr_eye_color_ineer_0 ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_eye_color_ineer_1 = Hex::fromString($request->qr_eye_color_ineer_1 ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_eye_color_ineer_2 = Hex::fromString($request->qr_eye_color_ineer_2 ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_eye_color_outer_0 = Hex::fromString($request->qr_eye_color_outer_0 ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_eye_color_outer_1 = Hex::fromString($request->qr_eye_color_outer_1 ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_eye_color_outer_2 = Hex::fromString($request->qr_eye_color_outer_2 ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_gradient_color_start = Hex::fromString($request->qr_gradient_color_start ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_gradient_color_end = Hex::fromString($request->qr_gradient_color_end ?? '#000000')->toRgb() ?? 'rgb(0,0,0)';
        $qr_gradient_type = $request->qr_gradient_type;
        $qr_attachment = $request->input('qr_attachment') ?? 'no';
        // return $qr_color;
        // 221,234,82

        $imageName = Str::slug($name) . '.' . $qr_img_type;


        $qr = QrCode::format($qr_img_type);
        $qr->size($qr_size);
        $qr->errorCorrection($qr_correction);
        $qr->encoding($qr_encoding);
        $qr->eye($eye);
        $qr->margin($qr_margin);
        $qr->style($qr_style);
        $qr->color($qr_color->red(), $qr_color->green(), $qr_color->blue());
        $qr->backgroundColor($qr_background_color->red(), $qr_background_color->green(), $qr_background_color->blue(), $qr_background_trancparent);
        $qr->eyeColor(0, $qr_eye_color_ineer_0->red(), $qr_eye_color_ineer_0->green(), $qr_eye_color_ineer_0->blue(), $qr_eye_color_outer_0->red(), $qr_eye_color_outer_0->green(), $qr_eye_color_outer_0->blue());
        $qr->eyeColor(1, $qr_eye_color_ineer_1->red(), $qr_eye_color_ineer_1->green(), $qr_eye_color_ineer_1->blue(), $qr_eye_color_outer_1->red(), $qr_eye_color_outer_1->green(), $qr_eye_color_outer_1->blue());
        $qr->eyeColor(2, $qr_eye_color_ineer_2->red(), $qr_eye_color_ineer_2->green(), $qr_eye_color_ineer_2->blue(), $qr_eye_color_outer_2->red(), $qr_eye_color_outer_2->green(), $qr_eye_color_outer_2->blue());
        $qr->gradient($qr_gradient_color_start->red(), $qr_gradient_color_start->green(), $qr_gradient_color_start->blue(), $qr_gradient_color_end->red(), $qr_gradient_color_end->green(), $qr_gradient_color_end->blue(), $qr_gradient_type);
        if ($qr_attachment != 'no') {
            $qr->merge('../public/images/logo01.png', 0.3, true);
        }
        $qr->generate($body, '../public/qr_code/' . $imageName);
        // $qr = QrCode::generate($body);
        // $qr = QrCode::generate('http://www.simplesoftware.io');

        return back()->with([
            'status' => 'QR Code generated successfully!',
            'image' => $imageName
        ]);

    }
}
