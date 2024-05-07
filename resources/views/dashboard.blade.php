@php
    $user = Auth::user();
@endphp
@php
    if (Auth::user()->role === 'Client') {
        abort(403);
    }
@endphp
@extends('layouts.backend')
@section('content')

@endsection
