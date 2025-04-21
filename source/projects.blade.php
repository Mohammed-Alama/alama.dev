@extends('_layouts.main')

@section('body')
    @php
        $currentPage = 'projects';
    @endphp
    @include('_partials.nav')

    <div class="terminal-page">
        <div class="terminal-section">
            <h1>Projects <span class="cursor"></span></h1>
            <p>A showcase of my work and contributions. Each project represents different challenges and solutions.</p>
        </div>

        <div class="terminal-section">
            <div class="terminal-prompt">
                <span>ls -la</span>
            </div>

            @foreach ($projects as $project)
                <div class="my-8 border-b border-terminal-border pb-6">
                    <h2 class="text-xl">
                        <a href="{{ $project->getUrl() }}">{{ $project->title }}</a>
                    </h2>
                    <div class="text-sm text-terminal-dim mt-1">
                        <span>{{ date('F j, Y', $project->date) }}</span>
                    </div>

                    @if ($project->technologies)
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach ($project->technologies as $tech)
                                <span class="inline-block px-2 py-1 text-xs rounded-md"
                                      style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">
                    {{ $tech }}
                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ $project->getUrl() }}" class="text-terminal-link hover:text-terminal-link-hover">
                            View details →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection 