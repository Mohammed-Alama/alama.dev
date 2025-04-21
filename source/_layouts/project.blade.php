@extends('_layouts.main')

@section('body')
    <nav class="terminal-nav">
        <div class="terminal-prompt">
            <span>cd ../</span>
        </div>
        <div class="terminal-nav-links">
            <a href="/" class="terminal-nav-link">home</a>
            <a href="/projects" class="terminal-nav-link active">projects</a>
            <a href="/experience" class="terminal-nav-link">experience</a>
            <a href="/books" class="terminal-nav-link">books</a>
            <a href="/contact" class="terminal-nav-link">contact</a>
        </div>
    </nav>

    <div class="terminal-page">
        <div class="terminal-section">
            <div class="terminal-prompt mb-4">
                <span>cat {{ $page->title }}.md</span>
            </div>

            <article class="prose">
                @yield('content')
            </article>

            @if ($page->technologies)
                <div class="mt-8">
                    <div class="terminal-section-title text-sm">Technologies</div>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach ($page->technologies as $tech)
                            <span class="inline-block px-3 py-1 text-xs rounded-md"
                                  style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">
                    {{ $tech }}
                </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-8">
                <a href="/projects" class="terminal-nav-link">&larr; Back to all projects</a>
            </div>
        </div>
    </div>
@endsection 