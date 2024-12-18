<?php
// Helper functions
function getPageTitle($title = null) {
    global $defaultMeta;
    return $title ? "$title - " . SITE_NAME : $defaultMeta['title'];
}

function getPageDescription($description = null) {
    global $defaultMeta;
    return $description ?: $defaultMeta['description'];
}

function renderComponent($name, $data = []) {
    extract($data);
    include "components/$name.php";
}