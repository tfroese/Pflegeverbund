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
    // Sanitize component name
    $name = basename($name);
    $componentPath = "components/$name.php";
    
    // Check if component exists
    if (!file_exists($componentPath)) {
        throw new Exception("Component '$name' not found");
    }
    
    // Create isolated scope for variables
    (function() use ($componentPath, $data) {
        extract($data);
        include $componentPath;
    })();
}
