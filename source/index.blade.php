@extends('_layouts.main')

@section('body')
    @php
        $currentPage = 'home';
    @endphp
    @include('_partials.nav')

    <div class="terminal-page">
        <div class="terminal-section">
            <h1>Mohammed Alama <span class="cursor"></span></h1>
            <p>Clean Coder | PHP Expert | Laravel Enthusiast</p>
        </div>

        @include('_partials.pages.index.about_me')
        @include('_partials.pages.index.skills')
        @include('_partials.pages.index.recent_projects')
        @include('_partials.pages.index.get_in_touch')
    </div>
@endsection
