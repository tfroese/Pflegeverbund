<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=getPageTitle($pageTitle ?? null); ?></title>
    <meta name="description" content="<?=getPageDescription($pageDescription ?? null); ?>">
    <?php if (DEV_MODE): ?>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
    <?php endif; ?>
    <link rel="stylesheet" href="<?=asset_url(CSS_URL . '/main.css'); ?>?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <?php if (isset($schemaMarkup)) echo $schemaMarkup; ?>
</head>
<body>

    <?php 
    renderComponent('top-bar');
    renderComponent('main-nav');
    ?>