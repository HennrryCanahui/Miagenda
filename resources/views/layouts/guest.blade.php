@extends('layouts.app')

@section('body_class', 'bg-gray-50 dark:bg-slate-950')

@section('layout')
    <div class="min-h-screen bg-gradient-to-b from-white via-blue-50/30 dark:from-slate-950 dark:via-slate-900/30 to-white dark:to-slate-950 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-500/10 dark:bg-indigo-500/10 rounded-full blur-3xl -mr-40 -mt-40 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 dark:bg-blue-500/10 rounded-full blur-3xl -ml-40 -mb-40 pointer-events-none"></div>

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
