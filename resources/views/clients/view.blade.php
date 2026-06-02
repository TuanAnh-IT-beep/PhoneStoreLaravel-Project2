@extends('clients.layouts.master')
@section('title', 'Search')
@section('main-content')
    @livewire('client.viewall', [
        'cateid' => $cateid ?? null,
        'id' => $id ?? null,
    ])
@endsection
