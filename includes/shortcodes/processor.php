<?php
require_once __DIR__ . '/faq.php';

/**
 * Process all shortcodes in content
 */
function process_shortcodes($content) {
    $shortcodes = [
        'faq' => '/\[faq\s+category-id=\'(\d+)\'(?:\s+limit=\'(\d+)\')?\s*\]/'
    ];
    
    foreach ($shortcodes as $type => $pattern) {
        $content = preg_replace_callback($pattern, function($matches) use ($type) {
            switch ($type) {
                case 'faq':
                    $category_id = $matches[1];
                    $limit = isset($matches[2]) ? (int)$matches[2] : null;
                    return render_faq_category($category_id, $limit);
                default:
                    return $matches[0];
            }
        }, $content);
    }
    
    return $content;
}