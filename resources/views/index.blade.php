@extends('layouts.app')
@section('content')
    <navbar 
        homelink="{{ route('index') }}"
        regilink="{{ route('register') }}"
        menu="{{ $menu }}"></navbar>
    {{-- <addform></addform> --}}
    <contacts></contacts>
@endsection
