<?php
function renderFaqItem($faq) {
    $detailUrl = '/faq/' . $faq['id'] . '/' . createFaqSlug($faq['question']);
    ?>
    <div class="faq-item">
        <button class="faq-item__question" aria-expanded="false" aria-controls="answer-<?= $faq['id'] ?>">
            <?= htmlspecialchars($faq['question']) ?>
        </button>
        <div class="faq-item__answer" id="answer-<?= $faq['id'] ?>">
            <div class="faq-item__short-answer">
                <?= htmlspecialchars($faq['answer_short']) ?>
            </div>
            <div class="faq-item__actions">
                <a href="<?= $detailUrl ?>" class="faq-item__more-link">Mehr erfahren</a>
            </div>
        </div>
    </div>
    <?php
}