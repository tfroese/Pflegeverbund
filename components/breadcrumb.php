<?php
function renderBreadcrumb($items) {
    echo '<div class="breadcrumb">
        <div class="container">
            <ul class="breadcrumb__list">
                <li class="breadcrumb__item"><a href="/">Home</a></li>';
    
    foreach ($items as $label => $url) {
        if ($url) {
            echo "<li class=\"breadcrumb__item\"><a href=\"$url\">$label</a></li>";
        } else {
            echo "<li class=\"breadcrumb__item\">$label</li>";
        }
    }
    
    echo '</ul>
        </div>
    </div>';
}
?>