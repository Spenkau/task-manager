@extends('layouts.layout')
@section('main')
    <x-sidebar :categories="$categories"></x-sidebar>
    @include('UIcomponents.timeDatePanel')
    @include('UIcomponents.addCategoryModal')
@endsection
