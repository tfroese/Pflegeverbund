<?php
/**
 * FAQ formatting utility functions
 */

function getShortAnswer($answer, $maxLength = 150) {
    // Split answer into short and detailed parts if it contains <!-- more --> tag
    if (strpos($answer, '<!-- more -->') !== false) {
        $parts = explode('<!-- more -->', $answer);
        return trim($parts[0]);
    }
    
    // Otherwise, create a short version
    $shortAnswer = strip_tags($answer);
    if (strlen($shortAnswer) > $maxLength) {
        return substr($shortAnswer, 0, $maxLength) . '...';
    }
    return $shortAnswer;
}

function getDetailedAnswer($answer) {
    if (strpos($answer, '<!-- more -->') !== false) {
        $parts = explode('<!-- more -->', $answer);
        return trim($parts[1]);
    }
    return $answer;
}

function createFaqSlug($question) {
    // Convert to lowercase and replace spaces with hyphens
    $slug = mb_strtolower($question, 'UTF-8');
    
    // Replace German special characters
    $replacements = [
        'ä' => 'ae',
        'ö' => 'oe',
        'ü' => 'ue',
        'ß' => 'ss'
    ];
    $slug = str_replace(array_keys($replacements), array_values($replacements), $slug);
    
    // Remove all characters except letters, numbers, and hyphens
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    
    // Remove multiple consecutive hyphens
    $slug = preg_replace('/-+/', '-', $slug);
    
    // Remove leading and trailing hyphens
    return trim($slug, '-');
}