@extends('admin.layout.master')

@section('body')
<x-heading main="Settings" secondery="Settings"></x-heading>
<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('admin.settings') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" name="site_name" class="form-control" placeholder="Site Name" value="{{ setting('site_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="inputImage">Logo</label>
                        <input type="file" name="logo" class="form-control" id="inputImage">
                        <img width="80" src="{{ asset(setting('logo')) }}" alt="">
                    </div>

                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="{{ setting('facebook') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Twitter</label>
                        <input type="text" name="twitter" class="form-control" placeholder="Twitter" value="{{ setting('twitter') }}">
                    </div>

                    <button class="btn btn-success">Save</button>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>

@endsection
