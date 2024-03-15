@extends('template.main')

@section('container')
    <div class="row">
        <div class="col-md-6">
            @include('partials.code')
        </div>
        <div class="col-md-6">
            @include('partials.main_admin')
        </div>
    </div>
@endsection