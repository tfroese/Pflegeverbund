<?php
/**
 * URL utility functions
 */

function createUrlSlug($text) {
    // Convert to lowercase and replace spaces with underscores
    $slug = mb_strtolower($text, 'UTF-8');
    
    // Replace German special characters
    $replacements = [
        'ä' => 'ae',
        'ö' => 'oe',
        'ü' => 'ue',
        'ß' => 'ss'
    ];
    $slug = str_replace(array_keys($replacements), array_values($replacements), $slug);
    
    // Remove all characters except letters, numbers, and underscores
    $slug = preg_replace('/[^a-z0-9_]+/', '_', $slug);
    
    // Remove multiple consecutive underscores
    $slug = preg_replace('/_+/', '_', $slug);
    
    // Remove leading and trailing underscores
    $slug = trim($slug, '_');
    
    return $slug;
}