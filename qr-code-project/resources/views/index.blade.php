@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-">
            <div class="card">
                <div class="card-header">{{ __('QR Code Builder') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-8">
                            <form method="POST" action="{{ route('do_qr_code_builder') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nmae</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <input type="text" name="body" value="{{ old('body') }}" class="form-control">
                                    @error('body')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="qr_size">QR Size</label>
                                            <select name="qr_size" class="form-control">
                                                <option value="">Select size</option>
                                                <option value="300">300*300</option>
                                                <option value="600">600*600</option>
                                                <option value="900">900*900</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="qr_img_type">Image Type</label>
                                            <select name="qr_img_type" class="form-control">
                                                <option value="">Select Image Type</option>
                                                <option value="png">PNG</option>
                                                <option value="svg">SVG</option>
                                                <option value="eps">EPS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="qr_correction">QR Correction</label>
                                            <select name="qr_correction" class="form-control">
                                                <option value="">Select QR Correction</option>
                                                <option value="L">7%</option>
                                                <option value="M">15%</option>
                                                <option value="Q">25%</option>
                                                <option value="H">30%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="qr_encoding">QR Encoding</label>
                                            <select name="qr_encoding" class="form-control">
                                                <option value="">Select QR Encoding</option>
                                                <option value="UTF-8">UTF-8</option>
                                                <option value="ISO-8859-1">ISO-8859-1</option>
                                                <option value="ISO-8859-2">ISO-8859-2</option>
                                                <option value="ISO-8859-3">ISO-8859-3</option>
                                                <option value="ISO-8859-4">ISO-8859-4</option>
                                                <option value="ISO-8859-5">ISO-8859-5</option>
                                                <option value="ISO-8859-6">ISO-8859-6</option>
                                                <option value="ISO-8859-7">ISO-8859-7</option>
                                                <option value="ISO-8859-8">ISO-8859-8</option>
                                                <option value="ISO-8859-9">ISO-8859-9</option>
                                                <option value="ISO-8859-10">ISO-8859-10</option>
                                                <option value="ISO-8859-11">ISO-8859-11</option>
                                                <option value="ISO-8859-12">ISO-8859-12</option>
                                                <option value="ISO-8859-13">ISO-8859-13</option>
                                                <option value="ISO-8859-14">ISO-8859-14</option>
                                                <option value="ISO-8859-15">ISO-8859-15</option>
                                                <option value="ISO-8859-16">ISO-8859-16</option>
                                                <option value="SHIFT-JIS">SHIFT-JIS</option>
                                                <option value="WINDOWS-1250">WINDOWS-1250</option>
                                                <option value="WINDOWS-1251">WINDOWS-1251</option>
                                                <option value="WINDOWS-1252">WINDOWS-1252</option>
                                                <option value="WINDOWS-1256">WINDOWS-1256</option>
                                                <option value="UTF-16BE">UTF-16BE</option>
                                                <option value="ASCII">ASCII</option>
                                                <option value="GBK">GBK</option>
                                                <option value="EUC-KR">EUC-KR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="qr_eye">QR Eye</label>
                                            <select name="qr_eye" class="form-control">
                                                <option value="">Select Qr Eye</option>
                                                <option value="square">Square</option>
                                                <option value="circle">Circle</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="qr_margin">QR Margin</label>
                                            <br>
                                            <input class="form-control" type="number" name="qr_margin" value="{{ old('qr_margin', 0) }}" min="0" max="100" step="1">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="qr_eye">QR Style</label>
                                            <select name="qr_style" class="form-control">
                                                <option value="">Select Qr Style</option>
                                                <option value="square">Square</option>
                                                <option value="dot">Dot</option>
                                                <option value="round">Round</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="qr_margin">QR Color</label>
                                            <br>
                                            <input class="form-control" type="color" name="qr_color" value="{{ old('qr_color', '#000000') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qr_background_color">QR BackGround Color</label>
                                            <br>
                                            <input class="form-control" type="color" name="qr_background_color" value="{{ old('qr_background_color', '#ffffff') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qr_background_trancparent">QR BackGround Trancparent</label>
                                            <br>
                                            <input class="form-control" type="number" name="qr_background_trancparent" value="{{ old('qr_background_trancparent', 0) }}" min="0" max="100" step="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qr_eye_color_ineer_0">QR Eye Color Ineer 0</label>
                                            <br>
                                            <input class="form-control" type="color" name="qr_eye_color_ineer_0" value="{{ old('qr_eye_color_ineer_0', '#000000') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qr_eye_color_outer_0">QR Eye Color Outer 0</label>
                                            <br>
                                            <input class="form-control" type="color" name="qr_eye_color_outer_0" value="{{ old('qr_eye_color_outer_0', '#000000') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qr_eye_color_ineer_1">QR Eye Color Ineer 1</label>
                                            <br>
                                            <input class="form-control" type="color" name="qr_eye_color_ineer_1" value="{{ old('qr_eye_color_ineer_1', '#000000') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qr_eye_color_outer_1">QR Eye Color Outer 1</label>
                                            <br>
                                            <input class="form-control" type="color" name="qr_eye_color_outer_1" value="{{ old('qr_eye_color_outer_1', '#000000') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qr_eye_color_ineer_2">QR Eye Color Ineer 2</label>
                                            <br>
                                            <input class="form-control" type="color" name="qr_eye_color_ineer_2" value="{{ old('qr_eye_color_ineer_2', '#000000') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qr_eye_color_outer_2">QR Eye Color Outer 2</label>
                                            <br>
                                            <input class="form-control" type="color" name="qr_eye_color_outer_2" value="{{ old('qr_eye_color_outer_2', '#000000') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary mt-2">Generate QR Code</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-4">
                            @if (session('image'))
                                @if (pathinfo(session('image'))['extension'] === 'eps')
                                    <div class="mt-3">
                                        Qr Code available, <a href="{{ asset('qr_code/' . session('image')) }}">click here</a> to download it.
                                    </div>
                                @else
                                    <img src="{{ asset('qr_code/' . session('image')) }}" class="img-fluid">
                                @endif
                                {{-- <h1>{{ session('image') }}</h1> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>@endsection
