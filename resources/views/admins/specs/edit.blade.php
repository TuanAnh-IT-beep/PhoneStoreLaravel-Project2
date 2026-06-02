@extends('admins.layouts.master')
@section('pageTitle', 'Specs - Edit')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Specs → {{ $spec->name }} → Edit</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <div class="main-container">
        <form method="post" action="{{ route('specs.update', $spec->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="name">Name:</label><br>
                            <input required class="mt-2 w-full" type="text" name="name"
                                placeholder="Input name here..." value="{{ $spec->name }}"><br>
                        </div>
                        <div class="w-full">
                            <label for="suffix">Suffix:</label><br>
                            <input class="my-3 w-full" type="text" name="suffix" placeholder="Input suffix here..." value="{{ $spec->suffix }}"><br>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">UPDATE</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('admins.settings.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
