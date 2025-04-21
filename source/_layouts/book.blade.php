@extends('_layouts.main')

@section('body')
    @php
        $currentPage = 'books';
    @endphp
    @include('_partials.nav')

    <div class="terminal-page">
        <div class="terminal-section">
            <div class="flex items-start">

                <div class="book-cover">
                    <img src="{{ getBookCoverUrl($page->title, $page->isbn ?? null) }}" alt="{{ $page->title }} cover">
                </div>

                <div class="flex-grow">
                    <h1 class="main-title">
                        <span class="text-terminal-secondary">#</span> {{ $page->title }} <span class="cursor"></span>
                    </h1>
                    <div class="text-terminal-dim">by {{ $page->author }}</div>

                    <div class="book-meta mt-4">
                        <div class="book-meta-item">
                            @if ($page->status === 'completed')
                                <span class="status-badge status-badge-completed">
                                <i class="fas fa-check-circle"></i> Completed
                            </span>
                            @elseif ($page->status === 'in-progress')
                                <span class="status-badge status-badge-in-progress">
                                <i class="fas fa-spinner fa-spin"></i> In Progress
                            </span>
                            @else
                                <span class="status-badge status-badge-to-read">
                                <i class="fas fa-bookmark"></i> To Read
                            </span>
                            @endif
                        </div>

                        @if ($page->date_finished)
                            <div class="book-meta-item">
                                <i class="far fa-calendar-check"></i> Finished
                                on {{ date('F j, Y', $page->date_finished) }}
                            </div>
                        @endif

                        @if ($page->rating)
                            <div class="book-meta-item">
                                <i class="fas fa-star"></i> Rating:
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $page->rating)
                                        <i class="fas fa-star text-terminal-accent"></i>
                                    @else
                                        <i class="far fa-star text-terminal-dim"></i>
                                    @endif
                                @endfor
                            </div>
                        @endif
                    </div>

                    @if ($page->categories)
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach ($page->categories as $category)
                                <span class="inline-block px-2 py-1 text-xs rounded-md"
                                      style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">
                        {{ $category }}
                    </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="terminal-section">
            <h2 class="section-heading">Description</h2>
            <p>{{ $page->description }}</p>
        </div>

        @if ($page->favorite_quote)
            <div class="terminal-section">
                <h2 class="section-heading">Favorite Quote</h2>
                <div class="book-quote">
                    "{{ $page->favorite_quote }}"
                </div>
            </div>
        @endif

        @if ($page->status === 'in-progress' && $page->current_page && $page->total_pages)
            <div class="terminal-section">
                <h2 class="section-heading">Reading Progress</h2>
                <div class="text-terminal-secondary">
                    <i class="fas fa-book-open"></i> {{ $page->current_page }}/{{ $page->total_pages }} pages
                    ({{ round(($page->current_page / $page->total_pages) * 100) }}%)
                </div>
                <div class="progress-bar mt-2">
                    <div class="progress-fill"
                         style="width: {{ ($page->current_page / $page->total_pages) * 100 }}%;"></div>
                </div>
            </div>
        @endif

        <div class="terminal-section">
            <div class="terminal-prompt">
                <span>cat notes.md</span>
            </div>

            <h2 class="section-heading">My Notes</h2>

            <div class="book-notes">
                @yield('content')
            </div>
        </div>

        <div class="mt-8">
            <a href="/books" class="terminal-nav-link">
                <i class="fas fa-arrow-left"></i> Back to all books
            </a>
        </div>
    </div>
@endsection 