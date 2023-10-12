
@extends('layouts.layout')
@section('main')

@component('components.Sidebar', ['categories' => $categories]) @endcomponent
@component('components.DatePanel') @endcomponent

@endsection
