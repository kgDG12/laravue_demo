@extends('layouts.app')
@section('content')
<navbar 
    homelink="{{ route('index') }}"
    regilink="{{ route('register') }}"
    menu="{{ $menu }}"></navbar>
    {{-- <h1>Register</h1> --}}

@endsection
