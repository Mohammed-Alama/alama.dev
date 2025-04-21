<?php

/**
 * Get book cover URL, with local caching
 *
 * @param string $title The book title
 * @param string|null $isbn The book ISBN (if available)
 *
 * @return string The URL to the book cover image
 */
function getBookCoverUrl(string $title, string $isbn = null): string
{
    // Define paths
    $localAssetsDir = 'source/assets/images/books';
    $webAssetsPath = '/assets/images/books';
    
    // If we have an ISBN, try to get the cover
    if ($isbn) {
        // First check if we already have this cover locally
        $localFilename = "{$localAssetsDir}/{$isbn}.jpg";
        $webPath = "{$webAssetsPath}/{$isbn}.jpg";
        
        // If we already have the file locally, return its URL
        if (file_exists($localFilename)) {
            return $webPath;
        }
        
        // File doesn't exist locally, try to fetch it from OpenLibrary
        $coverUrl = fetchAndSaveBookCover($isbn, $localFilename);
        if ($coverUrl) {
            return $webPath;
        }
    }
    
    // If no ISBN provided or cover not found, use placeholder
    return getBookPlaceholderCover($title);
}

/**
 * Fetch a book cover from OpenLibrary and save it locally
 *
 * @param string $isbn The book's ISBN
 * @param string $saveToPath The path to save the image to
 * @return bool True if successful, false otherwise
 */
function fetchAndSaveBookCover(string $isbn, string $saveToPath): bool
{
    // OpenLibrary Covers API URL
    $apiUrl = "https://covers.openlibrary.org/b/isbn/{$isbn}-L.jpg";
    
    // Ensure the directory exists
    $directory = dirname($saveToPath);
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
    
    // Fetch the image
    try {
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        $image = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Check if image is valid (not the default blank image)
        if ($statusCode === 200 && $image && strlen($image) > 1000) {
            // Save the image to the local path
            if (file_put_contents($saveToPath, $image)) {
                return true;
            }
        }
    } catch (\Exception $e) {
        // If any error occurs, return false
    }
    
    return false;
}

/**
 * Generate a colored placeholder image based on book title
 *
 * @param string $title The book title
 *
 * @return string URL to a placeholder image
 */
function getBookPlaceholderCover(string $title): string
{
    // Extract the first letter for a more personalized placeholder
    $firstLetter = strtoupper(substr($title, 0, 1));
    $text = urlencode($firstLetter);

    // Generate a consistent color based on the title
    $hash = md5($title);
    $color = substr($hash, 0, 6);

    return "https://via.placeholder.com/128x192/{$color}/FFFFFF?text={$text}";
}

