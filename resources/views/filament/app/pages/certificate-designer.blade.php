@extends('filament.app.layouts.certificate-layout')





@section('preset-template')
    @include('filament.app.components.preset-template', ['files' => $files])
    {{-- , ['files' => $files]) --}}
@endsection

@section('upload-template')
    @include('filament.app.components.upload-template')
@endsection
