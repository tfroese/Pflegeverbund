<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getPageTitle($pageTitle ?? null); ?></title>
    <meta name="description" content="<?php echo getPageDescription($pageDescription ?? null); ?>">
    <link rel="stylesheet" href="<?php echo $config['base_url']; ?>/src/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <?php if (isset($schemaMarkup)) echo $schemaMarkup; ?>
</head>
<body>
    <?php 
    renderComponent('top-bar');
    renderComponent('main-nav');
    ?>