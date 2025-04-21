@extends('_layouts.main')

@section('body')
    @php
        $currentPage = 'books';
        // Filter out books with 'draft' status
        // To mark a book as draft, set status: draft in the frontmatter
        // Draft books won't appear in listings but their individual pages will still be generated
        $nonDraftBooks = $books->filter(function ($book) {
            return $book->status !== 'draft';
        });
    @endphp
    @include('_partials.nav')

    <div class="terminal-page">
        <div class="terminal-section">
            <h1 class="main-title"><span class="text-terminal-secondary">#</span> Books <span class="cursor"></span>
            </h1>
            <p>A collection of books I've read and my thoughts on them.</p>
        </div>

        <div class="terminal-section">
            @foreach ($nonDraftBooks->filter(function ($book) {return $book->status === 'completed'; }) as $book)
                <div class="book-card mb-6">
                    <div class="flex justify-between items-start">
                        <div class="flex">
                            <div class="book-cover mr-4 flex-shrink-0">
                                <img src="{{ getBookCoverUrl($book->title, $book->isbn ?? null) }}"
                                     alt="Cover of {{ $book->title }}"
                                     class="w-24 h-auto shadow-md rounded" loading="lazy">
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <h3 class="mb-0 book-title">{{ $book->title }}</h3>
                                    <span class="status-badge status-badge-completed ml-1">
                                        <i class="fas fa-check-circle"></i> completed
                                    </span>
                                </div>
                                <div class="text-terminal-dim mt-1">By {{ $book->author }}</div>

                                @if ($book->date_finished)
                                    <div class="text-terminal-secondary text-sm mt-2">
                                        <i class="far fa-calendar-check"></i> Finished
                                        on {{ date('F j, Y', $book->date_finished) }}
                                    </div>
                                @endif

                                @if ($book->categories)
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @foreach ($book->categories as $category)
                                            <span class="category-tag">
                                                {{ $category }}
                                            </span>

                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        {{ $book->description }}
                    </div>

                    <div class="mt-4">
                        <a href="{{ $book->getUrl() }}" class="text-terminal-link hover:text-terminal-link-hover">
                            Read my notes →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="terminal-section">
            @foreach ($nonDraftBooks->filter(function ($book) {
                return $book->status === 'in-progress'; }) as $book)
                <div class="book-card mb-6">
                    <div class="flex justify-between items-start">
                        <div class="flex">
                            <div class="book-cover mr-4 flex-shrink-0">
                                <img src="{{ getBookCoverUrl($book->title, $book->isbn ?? null) }}"
                                     alt="Cover of {{ $book->title }}"
                                     class="w-24 h-auto shadow-md rounded" loading="lazy">
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <h3 class="mb-0 book-title">{{ $book->title }}</h3>
                                    <span class="status-badge status-badge-in-progress ml-1">
                                        <i class="fas fa-sync-alt fa-spin"></i> in progress
                                    </span>
                                </div>
                                <div class="text-terminal-dim mt-1">By {{ $book->author }}</div>

                                @if ($book->current_page && $book->total_pages)
                                    <div class="text-terminal-secondary text-sm mt-2">
                                        <i class="fas fa-book-open"></i> Progress: {{ $book->current_page }}
                                        /{{ $book->total_pages }} pages
                                        ({{ round(($book->current_page / $book->total_pages) * 100) }}%)

                                        <div class="progress-bar mt-1">
                                            <div class="progress-fill"
                                                 style="width: {{ ($book->current_page / $book->total_pages) * 100 }}%;"></div>
                                        </div>
                                    </div>
                                @endif

                                @if ($book->categories)
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @foreach ($book->categories as $category)
                                            <span class="category-tag">
                                                {{ $category }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        {{ $book->description }}
                    </div>

                    <div class="mt-4">
                        <a href="{{ $book->getUrl() }}" class="text-terminal-link hover:text-terminal-link-hover">
                            Read my thoughts so far →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="terminal-section">
            @foreach ($nonDraftBooks->filter(function ($book) {
        return $book->status === 'to-read'; }) as $book)
                <div class="book-card">
                    <div class="flex justify-between items-start">
                        <div class="flex">
                            <div class="book-cover mr-4 flex-shrink-0">
                                <img src="{{ getBookCoverUrl($book->title, $book->isbn ?? null) }}"
                                     alt="Cover of {{ $book->title }}"
                                     class="w-24 h-auto shadow-md rounded" loading="lazy">
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <h3 class="mb-0 book-title">{{ $book->title }}</h3>
                                    <span class="status-badge status-badge-to-read ml-1">
                                        <i class="fas fa-book-reader"></i> to read
                                    </span>
                                </div>
                                <div class="text-terminal-dim mt-1">By {{ $book->author }}</div>

                                @if ($book->categories)
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @foreach ($book->categories as $category)
                                            <span class="category-tag">
                                                {{ $category }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        {{ $book->description }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection 