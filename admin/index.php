<?php
require_once '../includes/config.php';
require_once '../includes/database.php';

$current_section = $_GET['section'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdn.tiny.cloud/1/eg5h3b2oiapcqpwui4blw8jut0y0aecadervw3z1b1bya6bx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-wrapper">
        <nav class="admin-nav">
            <h2>Navigation</h2>
            <ul>
                <li><a href="?section=guide-categories">Ratgeber Kategorien</a></li>
                <li><a href="?section=guides">Ratgeber</a></li>
                <li><a href="?section=faq-categories">FAQ Kategorien</a></li>
                <li><a href="?section=faq">FAQ</a></li>
            </ul>
        </nav>
        
        <main class="admin-content">
            <?php include "sections/{$current_section}.php"; ?>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.modal')) {
                const modal = document.getElementById('formModal');
                const span = document.getElementsByClassName('close')[0];

                if (modal && span) {
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            closeModal();
                        }
                    }

                    span.onclick = closeModal;
                }
            }
        });
    </script>
</body>
</html> 