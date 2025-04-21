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
                <div class="mb-10 border-l-2 border-terminal-border pl-4">
                    <div class="text-terminal-accent font-bold">Spryker</div>
                    <div class="text-terminal-secondary">Full Stack Developer</div>
                    <div class="text-terminal-dim text-sm">Jan 2022 - Present</div>

                    <div class="mt-2">
                        <ul>
                            <li>Developed custom e-commerce solutions using Spryker's framework</li>
                            <li>Optimized database queries and application code for improved performance</li>
                            <li>Implemented automated testing processes using PHPUnit and Codeception</li>
                            <li>Collaborated with multinational teams to deliver high-quality software</li>
                            <li>Participated in code reviews and mentored junior developers</li>
                        </ul>
                    </div>

                    <div class="mt-2">
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">PHP</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">Spryker</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">JavaScript</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">Docker</span>
                    </div>
                </div>

                <div class="mb-10 border-l-2 border-terminal-border pl-4">
                    <div class="text-terminal-accent font-bold">XYZ Tech</div>
                    <div class="text-terminal-secondary">Backend Developer</div>
                    <div class="text-terminal-dim text-sm">Jun 2020 - Dec 2021</div>

                    <div class="mt-2">
                        <ul>
                            <li>Designed and implemented RESTful APIs using Laravel</li>
                            <li>Built scalable data processing pipelines for analytics</li>
                            <li>Integrated third-party services and payment gateways</li>
                            <li>Maintained and improved existing codebase</li>
                            <li>Implemented CI/CD pipelines using GitHub Actions</li>
                        </ul>
                    </div>

                    <div class="mt-2">
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">Laravel</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">MySQL</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">Redis</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">AWS</span>
                    </div>
                </div>

                <div class="mb-10 border-l-2 border-terminal-border pl-4">
                    <div class="text-terminal-accent font-bold">ABC Agency</div>
                    <div class="text-terminal-secondary">Web Developer</div>
                    <div class="text-terminal-dim text-sm">Jan 2019 - May 2020</div>

                    <div class="mt-2">
                        <ul>
                            <li>Developed responsive websites for clients across various industries</li>
                            <li>Created custom WordPress themes and plugins</li>
                            <li>Implemented e-commerce solutions using WooCommerce</li>
                            <li>Worked directly with clients to gather requirements and provide support</li>
                        </ul>
                    </div>

                    <div class="mt-2">
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">PHP</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">WordPress</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">JavaScript</span>
                        <span class="inline-block px-2 py-1 text-xs rounded-md mr-1"
                              style="background-color: var(--terminal-code-bg); border: 1px solid var(--terminal-border);">HTML/CSS</span>
                    </div>
                </div>
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