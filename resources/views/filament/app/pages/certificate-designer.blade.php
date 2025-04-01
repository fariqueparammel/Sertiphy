{{-- resources/views/filament/app/pages/certificate-designer.blade.php --}}
@extends('filament.app.layouts.certificate-layout')

{{-- These sections correctly yield content into the layout --}}
@section('preset-template')
    {{-- Ensure $files variable is correctly passed from your Page class --}}
    @include('filament.app.components.preset-template', ['files' => $files ?? []])
@endsection

@section('upload-template')
    @include('filament.app.components.upload-template')
@endsection

@section('data')
    {{-- Ensure $firstRowData variable is correctly passed from your Page class --}}
    @include('filament.app.components.firstRowData', ['rowData' => $firstRowData ?? '[]'])
@endsection
