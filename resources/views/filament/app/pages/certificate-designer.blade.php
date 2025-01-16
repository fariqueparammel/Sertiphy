@extends('filament.app.layouts.certificate-layout')





@section('images')
    @include('filament.app.components.preset-template', ['files' => $files])
    {{-- , ['files' => $files]) --}}
@endsection
