@extends('_layouts.main')

@section('body')
    @php
        $currentPage = 'experience';
    @endphp
    @include('_partials.nav')

    <div class="terminal-page">
        <div class="terminal-section">
            <h1>Experience <span class="cursor"></span></h1>
            <p>My professional journey as a software developer.</p>
        </div>

        <div class="terminal-section">
            <div class="terminal-prompt">
                <span>cat experience.log</span>
            </div>

            <div class="mt-6">
                @include('_partials.pages.experience.ihf')
                @include('_partials.pages.experience.isdb')
                @include('_partials.pages.experience.actindo')
                @include('_partials.pages.experience.spryker')
                @include('_partials.pages.experience.nfq')
                @include('_partials.pages.experience.cec')
                @include('_partials.pages.experience.fritill')
                @include('_partials.pages.experience.mspired')
            </div>
        </div>

        <div class="terminal-section">
            <div class="terminal-section-title">Education</div>

            <div class="mb-6 border-l-2 border-terminal-border pl-4">
                <div class="text-terminal-accent font-bold">University of Technology</div>
                <div class="text-terminal-secondary">Bachelor of Computer Science</div>
                <div class="text-terminal-dim text-sm">2015 - 2019</div>

                <div class="mt-2">
                    <p>Focused on software engineering, database systems, and web development.</p>
                </div>
            </div>
        </div>
    </div>
@endsection 