<?php

/**
 * Fetch GitHub contributions data for a specific user
 *
 * @param string $username GitHub username
 * @param string $token GitHub personal access token with read:user scope
 * @param string|null $fromDate Start date in ISO format (YYYY-MM-DD)
 * @param string|null $toDate End date in ISO format (YYYY-MM-DD)
 *
 * @return array|null Contributions data or null on error
 */
function getGitHubContributions(string $username, string $token, string $fromDate = null, string $toDate = null): ?array
{
    if (!$username || !$token) {
        return null;
    }

    // Set default dates to the last year if not provided
    if (!$fromDate) {
        $fromDate = date('Y-m-d', strtotime('-1 year'));
    }
    if (!$toDate) {
        $toDate = date('Y-m-d');
    }

    $fromDate .= 'T00:00:00Z';
    $toDate .= 'T23:59:59Z';

    $query = <<<GRAPHQL
    query {
      user(login: "{$username}") {
        name
        contributionsCollection(from: "{$fromDate}", to: "{$toDate}") {
          contributionCalendar {
            totalContributions
            weeks {
              contributionDays {
                color
                contributionCount
                date
                weekday
              }
              firstDay
            }
          }
        }
      }
    }
    GRAPHQL;

    $data = [
        'query' => $query,
    ];

    $ch = curl_init('https://api.github.com/graphql');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: bearer ' . $token,
        'Content-Type: application/json',
        'User-Agent: PHP Script',
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return null;
    }

    $result = json_decode($response, true);

    if (isset($result['data']['user']['contributionsCollection'])) {
        return $result['data']['user'];
    }

    return null;
}

/**
 * Fetch GitHub PRs created by a user in an organization's repositories
 *
 * @param string $username GitHub username
 * @param string $token GitHub personal access token
 * @param string $org Organization name (e.g., 'Spryker')
 *
 * @return array|null PR data grouped by repository or null on error
 */
function getGitHubOrganizationPRs($username, $token, $org)
{
    if (!$username || !$token || !$org) {
        return null;
    }

    $query = <<<GRAPHQL
    query {
      search(query: "author:$username org:$org is:pr", type: ISSUE, first: 100) {
        issueCount
        edges {
          node {
            ... on PullRequest {
              title
              number
              state
              createdAt
              mergedAt
              closedAt
              url
              repository {
                name
                nameWithOwner
                url
              }
            }
          }
        }
      }
    }
    GRAPHQL;

    $data = [
        'query' => $query,
    ];

    $ch = curl_init('https://api.github.com/graphql');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: bearer ' . $token,
        'Content-Type: application/json',
        'User-Agent: PHP Script',
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return null;
    }

    $result = json_decode($response, true);

    if (isset($result['data']['search']['edges'])) {
        // Group PRs by repository
        $prsByRepo = [];

        foreach ($result['data']['search']['edges'] as $edge) {
            $pr = $edge['node'];
            $repoName = $pr['repository']['name'];

            if (!isset($prsByRepo[$repoName])) {
                $prsByRepo[$repoName] = [
                    'repository' => $pr['repository'],
                    'pullRequests' => [],
                ];
            }

            $prsByRepo[$repoName]['pullRequests'][] = $pr;
        }

        // Sort repositories by PR count (descending)
        uasort($prsByRepo, function ($a, $b) {
            return count($b['pullRequests']) - count($a['pullRequests']);
        });

        return $prsByRepo;
    }

    return null;
}