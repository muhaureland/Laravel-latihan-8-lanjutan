@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    {{-- cara padika --}}
    {{-- <h1 class="h2">welcome, {{ auth()->user()->name }}</h1> --}}

    {{-- cara bgfadil --}}
    <h1 class="h2">welcome, {{ Auth::user()->name }}</h1>
</div>
@endsection