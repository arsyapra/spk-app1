@extends('layout.layout')
@section('title','Dashboard')
@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  @if (Auth::user()->role === 'admin')
                  <h1>Selamat Datang {{ Auth::user()->name ?? 'Pengguna' }}</h1>
                  @else
                  <h1>Selamat Datang  {{ Auth::user()->name ?? 'Pengguna' }}</h1>
                      
                  @endif
                </div>
            </div>
        </div>
    </div>
@endsection
