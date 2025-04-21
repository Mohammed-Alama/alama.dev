<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="{{ $page->getUrl() }}">
    <meta name="description" content="{{ $page->description }}">
    <title>{{ $page->title ?? 'Mohammed Alama - Portfolio' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/terminal-style.css">
</head>
<body>
<div class="terminal-window">
    <div class="terminal-header">
        <div class="terminal-buttons">
            <div class="terminal-button terminal-close"></div>
            <div class="terminal-button terminal-minimize"></div>
            <div class="terminal-button terminal-maximize"></div>
        </div>
        <div class="terminal-title">alama@world: ~/</div>
    </div>
    <div class="terminal-content">
        @yield('body')
    </div>
</div>
@stack('scripts')
</body>
</html>
