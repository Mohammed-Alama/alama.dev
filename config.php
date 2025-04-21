<?php

// Load helper functions
require_once __DIR__ . '/app/helpers/media.php';
require_once __DIR__ . '/app/helpers/books.php';
require_once __DIR__ . '/app/helpers/github.php';

// Load .env file if it exists
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_contains($line, '=') && !str_starts_with($line, '#')) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            putenv("$key=$value");
        }
    }
}

// Get environment variables with defaults
$githubToken = getenv('GITHUB_TOKEN') ?: null;

return [
    'production' => false,
    'baseUrl' => '',
    'title' => 'Mohammed Alama - Portfolio',
    'description' => 'Mohammed Alama - Clean coder specializing in PHP, Laravel, and modern web technologies.',
    'name' => 'Mohammed Alama',
    'email' => 'contact@alama.dev',
    'github' => 'https://github.com/mohammed-alama',
    'linkedin' => 'https://www.linkedin.com/in/mohammed-alama/',
    'github_token' => $githubToken,
    'collections' => [
        'projects' => [
            'path' => 'projects/{filename}',
            'sort' => '-date',
        ],
        'books' => [
            'path' => 'books/{filename}',
            'sort' => '-date_finished',
            'extends' => '_layouts.book',
            'draft' => false,
        ],
        'conferences' => [
            'path' => 'conferences/{filename}',
            'sort' => '-date_watched',
        ],
    ],
];
