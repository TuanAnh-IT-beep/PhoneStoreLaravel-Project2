@extends('clients.layouts.master')
@section('main-content')
    
                @livewire("client.viewall", [
                    'cateid' => $cateid ?? null,
                    'id' => $id ?? null
                ])

@endsection
