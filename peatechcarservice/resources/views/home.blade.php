@extends('layouts.app')

@section('title', 'Home | Peamech Car Service')

@section('content')
    @include('partials.carousel')
    {{-- @include('partials.service-tab') --}}
    @include('partials.about')
    @include('partials.facts')
    @include('partials.booking')
    @include('partials.team')
@endsection
