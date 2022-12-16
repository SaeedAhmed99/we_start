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
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary mt-2">Generate QR Code</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-4">
                            @if (session('image'))
                                <img src="{{ asset('qr_code/' . session('image')) }}">
                                {{-- <h1>{{ session('image') }}</h1> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>@endsection
