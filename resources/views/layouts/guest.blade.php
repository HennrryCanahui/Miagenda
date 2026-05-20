@extends('layouts.app')

@section('body_class', 'bg-gray-50 dark:bg-blue-950')

@section('layout')
    <div class="min-h-screen bg-gradient-to-b from-white via-blue-50/30 dark:from-slate-950 dark:via-slate-900/30 to-white dark:to-slate-950">
        @isset($header)
            <header class="bg-gradient-to-r from-indigo-600 to-blue-600 dark:from-indigo-700 dark:to-blue-700 shadow-lg border-b border-indigo-500/20">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-bold text-3xl tracking-tight leading-tight text-white drop-shadow-sm">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>
@endsection
