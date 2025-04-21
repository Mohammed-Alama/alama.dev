<nav class="terminal-nav">
    <div class="terminal-prompt">
        <span>cd ./{{ $currentPage ?? 'home' }}</span>
    </div>
    <div class="terminal-nav-links">
        <a href="/" class="terminal-nav-link {{ $currentPage == 'home' ? 'active' : '' }}">home</a>
        <a href="/projects" class="terminal-nav-link {{ $currentPage == 'projects' ? 'active' : '' }}">projects</a>
        <a href="/experience"
           class="terminal-nav-link {{ $currentPage == 'experience' ? 'active' : '' }}">experience</a>
        <a href="/books" class="terminal-nav-link {{ $currentPage == 'books' ? 'active' : '' }}">books</a>
        <a href="/conferences"
           class="terminal-nav-link {{ $currentPage == 'conferences' ? 'active' : '' }}">conferences</a>
        <a href="/github" class="terminal-nav-link {{ $currentPage == 'github' ? 'active' : '' }}">github</a>
        <a href="/contact" class="terminal-nav-link {{ $currentPage == 'contact' ? 'active' : '' }}">contact</a>
    </div>
</nav> 