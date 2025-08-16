@extends('_layouts.main')

@section('body')
        @php
    $currentPage = 'conferences';

    // Always get YouTube thumbnail from video URL
    $youtube_thumbnail = null;
    if ($page->video_url) {
        $youtube_thumbnail = getYouTubeThumbnail($page->video_url);
    }
        @endphp
        @include('_partials.nav')

        <div class="terminal-page">
            <div class="terminal-section">
                <div class="flex flex-end">
                    @if ($youtube_thumbnail)
                        <div class="conference-cover">
                            <img src="{{ $youtube_thumbnail }}" alt="{{ $page->title }} thumbnail">
                        </div>
                    @endif

                    <div class="flex-grow">
                        <h1 class="main-title">
                            <span class="text-terminal-secondary">#</span> {{ $page->title }} <span class="cursor"></span>
                        </h1>
                        <div class="text-terminal-dim">by {{ $page->presenter }}</div>

                        <div class="conference-meta mt-4">
                            @if ($page->date_watched)
                                <div class="conference-meta-item">
                                    <i class="far fa-calendar-check"></i> Watched
                                    on {{ date('F j, Y', $page->date_watched) }}
                                </div>
                            @endif

                            @if ($page->rating)
                                <div class="conference-meta-item">
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
                                    <span class="category-tag">
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

            @if ($page->venue)
                <div class="terminal-section">
                    <h2 class="section-heading">Venue</h2>
                    <p>{{ $page->venue }}</p>
                </div>
            @endif

            @if ($page->favorite_quote)
                <div class="terminal-section">
                    <h2 class="section-heading">Favorite Quote</h2>
                    <div class="conference-quote">
                        "{{ $page->favorite_quote }}"
                    </div>
                </div>
            @endif

            @if ($page->video_url)
                <div class="terminal-section">
                    <h2 class="section-heading">Video Link</h2>
                    <a href="{{ $page->video_url }}" target="_blank"
                       class="text-terminal-link hover:text-terminal-link-hover">
                        <i class="fas fa-external-link-alt"></i> Watch on {{ parse_url($page->video_url, PHP_URL_HOST) }}
                    </a>
                </div>
            @endif

            <div class="terminal-section">
                <div class="terminal-prompt">
                    <span>cat notes.md</span>
                </div>

                <h2 class="section-heading">My Notes</h2>

                <div class="conference-notes">
                    @yield('content')
                </div>
            </div>

            <div class="mt-8">
                <a href="/conferences" class="terminal-nav-link">
                    <i class="fas fa-arrow-left"></i> Back to all conferences
                </a>
            </div>
        </div>
@endsection 