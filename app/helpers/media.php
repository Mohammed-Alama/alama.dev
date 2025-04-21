<?php

/**
 * Extract YouTube thumbnail URL from a YouTube video URL
 *
 * @param string $videoUrl The YouTube video URL
 *
 * @return string|null The thumbnail URL or null if not a valid YouTube URL
 */
function getYouTubeThumbnail(string $videoUrl): ?string
{
    if (!$videoUrl) {return null;}

    $videoId = extractYouTubeId($videoUrl);

    if ($videoId) {
        return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
    }

    return null;
}

/**
 * Extract YouTube video ID from a YouTube URL
 * Supports various YouTube URL formats
 *
 * @param string $url The YouTube URL
 *
 * @return string|null The YouTube video ID or null if not a valid YouTube URL
 */
function extractYouTubeId(string $url): ?string
{
    $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

    if (preg_match($pattern, $url, $matches)) {
        return $matches[1];
    }

    return null;
}