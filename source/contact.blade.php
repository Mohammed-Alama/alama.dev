@extends('_layouts.main')

@section('body')
    @php
        $currentPage = 'contact';
    @endphp
    @include('_partials.nav')

    <div class="terminal-page">
        <div class="terminal-section">
            <h1>Contact <span class="cursor"></span></h1>
            <p>Interested in working together? Get in touch with me through the channels below.</p>
        </div>

        <div class="terminal-section">
            <div class="terminal-prompt">
                <span>cat contact_info.txt</span>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-6">
                        <div class="text-terminal-accent font-bold mb-1">Email</div>
                        <a href="mailto:{{ $page->email }}" class="text-terminal-link">{{ $page->email }}</a>
                    </div>

                    <div class="mb-6">
                        <div class="text-terminal-accent font-bold mb-1">GitHub</div>
                        <a href="{{ $page->github }}" target="_blank" class="text-terminal-link">{{ $page->github }}</a>
                    </div>

                    <div class="mb-6">
                        <div class="text-terminal-accent font-bold mb-1">LinkedIn</div>
                        <a href="{{ $page->linkedin }}" target="_blank"
                           class="text-terminal-link">{{ $page->linkedin }}</a>
                    </div>
                    <div class="mb-6">
                        <div class="text-terminal-accent font-bold mb-1">Location</div>
                        <p>Based in: <span class="text-terminal-secondary">Cairo, Egypt</span></p>
                        <p class="text-terminal-dim">Available for remote work worldwide</p>
                    </div>
                    <div class="mb-6">
                        <div class="mt-2 text-terminal-secondary">
                            Looking forward to hearing from you!
                        </div>
                    </div>
                </div>

                <div class="bg-terminal-code-bg p-6 rounded-md border border-terminal-border">
                    <div class="text-terminal-prompt mb-4">$ Send me a message</div>
                    <form action="#" method="POST" class="contact-form">
                        <div class="mb-4">
                            <label for="name" class="block text-terminal-dim mb-1">Name:</label>
                            <input type="text" id="name" name="name"
                                   class="w-full bg-terminal-bg border border-terminal-border p-2 rounded text-terminal-text focus:border-terminal-accent focus:outline-none">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-terminal-dim mb-1">Email:</label>
                            <input type="email" id="email" name="email"
                                   class="w-full bg-terminal-bg border border-terminal-border p-2 rounded text-terminal-text focus:border-terminal-accent focus:outline-none">
                        </div>

                        <div class="mb-4">
                            <label for="message" class="block text-terminal-dim mb-1">Message:</label>
                            <textarea id="message" name="message" rows="5"
                                      class="w-full bg-terminal-bg border border-terminal-border p-2 rounded text-terminal-text focus:border-terminal-accent focus:outline-none"></textarea>
                        </div>

                        <button type="submit"
                                class="bg-terminal-header-bg border border-terminal-border px-4 py-2 rounded hover:bg-terminal-bg hover:border-terminal-accent transition">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{--    <div class="terminal-section mt-8">--}}
        {{--        <div class="terminal-section-title">Location</div>--}}
        {{--        <p>Based in: <span class="text-terminal-secondary">Cairo, Egypt</span></p>--}}
        {{--        <p class="text-terminal-dim">Available for remote work worldwide</p>--}}
        {{--    </div>--}}

        {{--    <div class="terminal-section mt-8">--}}
        {{--        <div class="terminal-prompt">--}}
        {{--            <span>echo "Looking forward to hearing from you!"</span>--}}
        {{--        </div>--}}
        {{--        <div class="mt-2 text-terminal-secondary">--}}
        {{--            Looking forward to hearing from you!--}}
        {{--        </div>--}}
        {{--    </div>--}}
    </div>
@endsection 