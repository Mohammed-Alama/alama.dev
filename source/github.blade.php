@extends('_layouts.main')

@section('body')
    @php
        $currentPage = 'github';

        // Get token from config
        $token = $page->github_token ?: 'YOUR_GITHUB_TOKEN';
        $username = 'm-alama';

        // Set the year to 2022 specifically
        $targetYear = 2022;

        $yearContributions = null;
        $sprykerPRs = null;

        if ($token && $token !== 'YOUR_GITHUB_TOKEN') {
            // Get contributions for 2022
            $yearContributions = getGitHubContributions(
                $username,
                $token,
                "$targetYear-01-01",
                "$targetYear-12-31"
            );

            // Get PRs in Spryker organization repositories
            $sprykerPRs = getGitHubOrganizationPRs($username, $token, 'spryker');
        }

        // Adapt data format if needed to match the template's expectations
        if ($yearContributions && isset($yearContributions['contributionsCollection'])) {
            // This means we're using the function from MediaHelpers.php
            $totalContributions = $yearContributions['contributionsCollection']['contributionCalendar']['totalContributions'] ?? 0;
            $weeks = $yearContributions['contributionsCollection']['contributionCalendar']['weeks'] ?? [];
        } else {
            // Fallback for original format
            $totalContributions = $yearContributions['contributionsCollection']['contributionCalendar']['totalContributions'] ?? 0;
            $weeks = $yearContributions['contributionsCollection']['contributionCalendar']['weeks'] ?? [];
        }

        // Count PR stats
        $totalPRs = 0;
        $mergedPRs = 0;
        $repoCount = 0;

        if ($sprykerPRs) {
            $repoCount = count($sprykerPRs);

            foreach ($sprykerPRs as $repo) {
                $totalPRs += count($repo['pullRequests']);

                foreach ($repo['pullRequests'] as $pr) {
                    if ($pr['mergedAt']) {
                        $mergedPRs++;
                    }
                }
            }
        }

        // Helper function to format dates
        function formatDate($dateString)
        {
            return date('M j, Y', strtotime($dateString));
        }
    @endphp
    @include('_partials.nav')

    <div class="terminal-page">
        <div class="terminal-section">
            <h1 class="main-title"><span class="text-terminal-secondary">#</span> GitHub @ Spryker <span
                        class="cursor"></span></h1>
            <p>Contributions to Spryker projects using my work GitHub account ({{ $username }}) during {{ $targetYear }}
                .</p>
        </div>

        <div class="terminal-section">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="section-heading">{{ $targetYear }} Summary</h2>
                </div>
                <div>
                    <a href="https://github.com/{{ $username }}?tab=overview&from={{ $targetYear }}-01-01&to={{ $targetYear }}-12-31"
                       target="_blank" class="text-terminal-link hover:text-terminal-link-hover">
                        <i class="fab fa-github"></i> View on GitHub →
                    </a>
                </div>
            </div>

            <div class="stats-container mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="stat-card bg-terminal-code-bg p-4 rounded border border-terminal-border">
                        <div class="text-terminal-secondary text-sm">Total Contributions</div>
                        <div class="text-2xl mt-2">{{ $totalContributions }}</div>
                    </div>

                    <div class="stat-card bg-terminal-code-bg p-4 rounded border border-terminal-border">
                        <div class="text-terminal-secondary text-sm">Repositories</div>
                        <div class="text-2xl mt-2">{{ $repoCount }}</div>
                    </div>

                    <div class="stat-card bg-terminal-code-bg p-4 rounded border border-terminal-border">
                        <div class="text-terminal-secondary text-sm">Pull Requests</div>
                        <div class="text-2xl mt-2">{{ $totalPRs }}</div>
                    </div>

                    <div class="stat-card bg-terminal-code-bg p-4 rounded border border-terminal-border">
                        <div class="text-terminal-secondary text-sm">Merged PRs</div>
                        <div class="text-2xl mt-2">{{ $mergedPRs }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="terminal-section">
            <h2 class="section-heading">Contribution Timeline ({{ $targetYear }})</h2>

            <div class="contribution-graph mt-4 p-4 bg-terminal-code-bg rounded border border-terminal-border overflow-x-auto">
                @if (!empty($weeks))
                    <div class="contribution-calendar">
                        <div class="flex flex-wrap">
                            @foreach ($weeks as $week)
                                <div class="week mr-1">
                                    @foreach ($week['contributionDays'] as $day)
                                        <div
                                                class="day w-3 h-3 mb-1 rounded-sm"
                                                style="background-color: {{ $day['color'] }};"
                                                title="{{ date('F j, Y', strtotime($day['date'])) }}: {{ $day['contributionCount'] }} contributions"
                                        ></div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-between text-xs text-terminal-dim mt-4">
                            <div>Less</div>
                            <div class="flex items-center">
                                <div class="day w-3 h-3 mx-1 rounded-sm" style="background-color: #ebedf0;"></div>
                                <div class="day w-3 h-3 mx-1 rounded-sm" style="background-color: #9be9a8;"></div>
                                <div class="day w-3 h-3 mx-1 rounded-sm" style="background-color: #40c463;"></div>
                                <div class="day w-3 h-3 mx-1 rounded-sm" style="background-color: #30a14e;"></div>
                                <div class="day w-3 h-3 mx-1 rounded-sm" style="background-color: #216e39;"></div>
                            </div>
                            <div>More</div>
                        </div>
                    </div>
                @else
                    <div class="text-terminal-dim p-4">No contribution data available for {{ $targetYear }}.</div>
                @endif
            </div>
        </div>

        <div class="terminal-section">
            <h2 class="section-heading">Pull Requests by Repository</h2>

            @if ($sprykerPRs)
                <div class="w-full space-y-6">
                    @foreach ($sprykerPRs as $repoName => $repoData)
                        @php
                            // Get PRs for 2022 only
                            $repoPRs = [];
                            $prCount = 0;
                            foreach ($repoData['pullRequests'] as $pr) {
                                $prYear = date('Y', strtotime($pr['createdAt']));
                                if ($prYear == $targetYear) {
                                    $repoPRs[] = $pr;
                                    $prCount++;
                                }
                            }

                            // Create a safe repo ID for folding
                            $foldId = 'repo-' . md5($repoData['repository']['nameWithOwner']);
                        @endphp

                        <div class="terminal-card bg-terminal-code-bg border border-terminal-border rounded overflow-hidden w-full">
                            <div class="flex items-center p-4 justify-between w-full">
                                <div class="flex items-center self-center">
                                    <div class="flex items-center self-center">
                                        <span class="text-terminal-link mr-2 font-mono flex items-center"
                                              style="font-size: 1.25rem;">#</span>
                                        <i class="fas fa-code-branch text-terminal-link mr-3"
                                           style="font-size: 1.25rem; display: flex; align-items: center;"></i>
                                        <a href="{{ $repoData['repository']['url'] }}" target="_blank"
                                           class="font-mono text-terminal-link hover:text-terminal-link-hover flex items-center">
                                            {{ $repoData['repository']['nameWithOwner'] }}
                                        </a>
                                        <span class="ml-3 text-xs text-terminal-text bg-terminal-secondary bg-opacity-20 px-2 py-1 rounded flex items-center">({{ count($repoPRs) }} PRs)</span>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <button
                                            type="button"
                                            class="focus:outline-none w-8 h-8 flex items-center justify-center transition-transform duration-200"
                                            onclick="toggleRepo('{{ $foldId }}')"
                                    >
                                        <i id="icon-{{ $foldId }}" class="fas fa-chevron-down text-terminal-link"
                                           style="transform-origin: center; font-size: 1.25rem;"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="h-px bg-terminal-border w-full"></div>

                            @if (count($repoPRs) > 0)
                                <div id="{{ $foldId }}" class="repo-content" style="display: none;">
                                    <div class="overflow-x-auto w-full">
                                        <table class="w-full">
                                            <thead class="bg-terminal-dim bg-opacity-30">
                                            <tr class="text-left text-sm text-terminal-secondary">
                                                <th class="py-3 px-4 font-mono font-medium">PR</th>
                                                <th class="py-3 px-4 font-medium">Title</th>
                                                <th class="py-3 px-4 font-medium">Created</th>
                                                <th class="py-3 px-4 font-medium">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-sm text-terminal-text">
                                            @foreach ($repoPRs as $pr)
                                                @php
                                                    // Determine status class
                                                    $statusClass = 'text-terminal-secondary';
                                                    $statusIcon = '';

                                                    if ($pr['state'] == 'MERGED') {
                                                        $statusClass = 'text-terminal-green font-medium';
                                                        $statusIcon = '<i class="fas fa-check-circle mr-1"></i>';
                                                    } elseif ($pr['state'] == 'CLOSED') {
                                                        $statusClass = 'text-terminal-red';
                                                        $statusIcon = '<i class="fas fa-times-circle mr-1"></i>';
                                                    } elseif ($pr['state'] == 'OPEN') {
                                                        $statusClass = 'text-terminal-blue';
                                                        $statusIcon = '<i class="fas fa-circle mr-1"></i>';
                                                    }

                                                    // Format date in one line
                                                    $formattedDate = formatDate($pr['createdAt']);
                                                @endphp
                                                <tr class="border-t border-terminal-border hover:bg-terminal-border hover:bg-opacity-10">
                                                    <td class="py-3 px-4 font-mono">
                                                        <a href="{{ $pr['url'] }}" target="_blank"
                                                           class="text-terminal-link hover:text-terminal-link-hover">
                                                            #{{ $pr['number'] }}
                                                        </a>
                                                    </td>
                                                    <td class="py-3 px-4">{{ $pr['title'] }}</td>
                                                    <td class="py-3 px-4 whitespace-nowrap text-terminal-dim">{{ $formattedDate }}</td>
                                                    <td class="py-3 px-4 {{ $statusClass }}">{!! $statusIcon !!}{{ $pr['state'] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div id="{{ $foldId }}" class="repo-content py-4 px-4 text-center text-terminal-dim"
                                     style="display: none;">
                                    No pull requests found for {{ $targetYear }}.
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mt-4 p-4 bg-terminal-code-bg rounded border border-terminal-border text-terminal-dim">
                    <p>No pull requests found or GitHub token not configured.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        /* Global style to make all buttons appear borderless */
        button {
            background: transparent;
            border: none;
            outline: none;
            padding: 0;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
        }

        /* Ensure icons inside buttons maintain their color */
        button i {
            color: inherit;
        }

        /* Fix for chevron rotation */
        .fa-chevron-down {
            display: inline-block;
            transform-origin: center center;
        }
    </style>
    <script>
        // Wait for DOM to be ready
        document.addEventListener('DOMContentLoaded', function () {
            // Hide all repo content initially
            document.querySelectorAll('.repo-content').forEach(function (content) {
                content.style.display = 'none';
            });
        });

        function toggleRepo(id) {
            var content = document.getElementById(id);
            var icon = document.getElementById('icon-' + id);

            if (content && icon) {
                if (content.style.display === 'none') {
                    content.style.display = 'block';
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    content.style.display = 'none';
                    icon.style.transform = '';
                }
            }
        }
    </script>
@endpush 