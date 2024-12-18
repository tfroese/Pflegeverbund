<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/url-functions.php';
require_once 'includes/faq-functions.php';

// Get all FAQ questions grouped by category
$questionsByCategory = getFAQQuestionsByCategory();

// Set page title and description
$pageTitle = 'Häufig gestellte Fragen (FAQ)';
$pageDescription = 'Finden Sie Antworten auf häufig gestellte Fragen rund um das Thema Pflege, Pflegegrade und Pflegeleistungen.';

// Generate breadcrumb items
$breadcrumbItems = [
    ['label' => 'Home', 'url' => SITE_PATH . '/'],
    ['label' => 'FAQ', 'url' => SITE_PATH . '/faq']
];

// Start output buffering
ob_start();

renderComponent('breadcrumb', ['items' => $breadcrumbItems]);
?>

<main class="main-content">
    <div class="container">
        <h1 class="page-title">Häufig gestellte Fragen (FAQ)</h1>
        
        <div class="faq-search">
            <div class="faq-search__container">
                <input type="text" 
                       id="faqSearch" 
                       class="faq-search__input" 
                       placeholder="Suchen Sie nach Fragen..."
                       aria-label="FAQ durchsuchen">
                <div id="searchResults" class="faq-search__results" hidden></div>
            </div>
        </div>
        
        <div class="faq-container">
            <?php foreach ($questionsByCategory as $category => $questions): ?>
                <section class="faq-category" id="<?= createUrlSlug($category) ?>">
                    <h2 class="faq-category__title"><?= htmlspecialchars($category) ?></h2>
                    
                    <div class="faq-list">
                        <?php foreach ($questions as $question): ?>
                            <div class="faq-item" data-faq-id="<?= $question['id'] ?>">
                                <button class="faq-question" aria-expanded="false">
                                    <?= htmlspecialchars($question['question']) ?>
                                    <span class="faq-icon"></span>
                                </button>
                                
                                <div class="faq-answer" hidden>
                                    <div class="faq-answer__content">
                                        <?= strip_tags($question['answer_short'], '<b><strong><a><ul><li><ol><p>') ?>
                                    </div>
                                    <a href="<?= SITE_PATH ?>/faq/<?= $question['id'] ?>/<?= createUrlSlug($question['question']) ?>" 
                                       class="faq-answer__more">
                                        Mehr erfahren →
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include 'components/base-layout.php';
?>