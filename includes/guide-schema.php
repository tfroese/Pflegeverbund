<?php
/**
 * Schema.org markup generator for guides
 */

function generateGuideSchema($guide) {
    return [
        "@context" => "https://schema.org",
        "@type" => "Article",
        "headline" => $guide['headline'],
        "description" => $guide['subheadline'] ?? '',
        "image" => [
            "@type" => "ImageObject",
            "url" => SITE_URL . ($guide['image_path'] ?? '/images/default-guide.jpg'),
        ],
        "datePublished" => date(DATE_ISO8601, strtotime($guide['published_on'])),
        "dateModified" => date(DATE_ISO8601, strtotime($guide['updated_on'])),
        "author" => [
            "@type" => "Organization",
            "name" => SITE_NAME
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => SITE_NAME,
            "logo" => [
                "@type" => "ImageObject",
                "url" => SITE_URL . "/images/logo.svg"
            ]
        ],
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => getCurrentUrl()
        ]
    ];
}