@extends('_layouts.main')

@section('body')
    @php
        $currentPage = 'conferences';
    @endphp
    @include('_partials.nav')

    <div class="terminal-page">
        <div class="terminal-section">
            <h1 class="main-title"><span class="text-terminal-secondary">#</span> Conferences <span
                        class="cursor"></span></h1>
            <p>A collection of tech conferences and talks I've watched and found valuable.</p>
        </div>

        <div class="terminal-section">
            @foreach ($conferences->sortByDesc('date_watched') as $conference)
                @php
                    // Get YouTube thumbnail from video URL
                    $youtube_thumbnail = null;
                    if ($conference->video_url) {
                        $youtube_thumbnail = getYouTubeThumbnail($conference->video_url);
                    }
                @endphp
                <div class="conference-card mb-6 border-l-2 border-terminal-border pl-4">
                    <div class="flex items-start">
                        @if ($youtube_thumbnail)
                            <div class="conference-thumbnail">
                                <img src="{{ $youtube_thumbnail }}" alt="{{ $conference->title }} thumbnail">
                            </div>
                        @endif
                        <div class="flex-grow">
                            <div class="flex justify-between items-start" style="justify-content: space-between;">
                                <div>
                                    <h3 class="mb-0 book-title">{{ $conference->title }}</h3>
                                    <div class="text-terminal-dim mt-1">By {{ $conference->presenter }}</div>
                                </div>
                            </div>

                            @if ($conference->date_watched)
                                <div class="text-terminal-secondary text-sm mt-2">
                                    <i class="far fa-calendar-check"></i> Watched
                                    on {{ date('F j, Y', $conference->date_watched) }}
                                </div>
                            @endif

                            @if ($conference->venue)
                                <div class="text-terminal-secondary text-sm mt-1">
                                    <i class="fas fa-map-marker-alt"></i> {{ $conference->venue }}
                                </div>
                            @endif

                            @if ($conference->categories)
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach ($conference->categories as $category)
                                        <span class="category-tag">{{ $category }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-3">{{ $conference->description }}</div>

                            <div class="mt-4">
                                <a href="{{ $conference->getUrl() }}"
                                   class="text-terminal-link hover:text-terminal-link-hover">
                                    Read my notes →
                                </a>

                                @if ($conference->video_url)
                                    <a href="{{ $conference->video_url }}" target="_blank"
                                       class="text-terminal-link hover:text-terminal-link-hover ml-4">
                                        <i class="fas fa-external-link-alt"></i> Watch video
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection 