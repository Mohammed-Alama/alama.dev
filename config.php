<?php

// Load helper functions
require_once __DIR__ . '/app/helpers/media.php';
require_once __DIR__ . '/app/helpers/books.php';

return [
    'production' => false,
    'baseUrl' => '',
    'title' => 'Mohammed Alama',
    'description' => 'Mohammed Alama - Clean coder specializing in PHP, Laravel, and modern web technologies.',
    'name' => 'Mohammed Alama',
    'email' => 'contact@alama.dev',
    'github' => 'https://github.com/mohammed-alama',
    'linkedin' => 'https://www.linkedin.com/in/mohammed-alama/',
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
