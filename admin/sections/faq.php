<?php
$db = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $sql = "INSERT INTO faq_questions (category_id, question, answer_short, answer_extended, sort_order) 
                        VALUES (:category_id, :question, :answer_short, :answer_extended, :sort_order)";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':category_id' => $_POST['category_id'],
                    ':question' => $_POST['question'],
                    ':answer_short' => $_POST['answer_short'],
                    ':answer_extended' => $_POST['answer_extended'],
                    ':sort_order' => $_POST['sort_order'] ?? 0
                ]);
                break;

            case 'update':
                if (!isset($_POST['id'])) {
                    die('Error: No ID provided for update');
                }
                $sql = "UPDATE faq_questions SET 
                        category_id = :category_id, 
                        question = :question, 
                        answer_short = :answer_short, 
                        answer_extended = :answer_extended, 
                        sort_order = :sort_order 
                        WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':category_id' => $_POST['category_id'],
                    ':question' => $_POST['question'],
                    ':answer_short' => $_POST['answer_short'],
                    ':answer_extended' => $_POST['answer_extended'],
                    ':sort_order' => $_POST['sort_order'] ?? 0,
                    ':id' => $_POST['id']
                ]);
                break;

            case 'delete':
                if (!isset($_POST['id'])) {
                    die('Error: No ID provided for deletion');
                }
                $sql = "DELETE FROM faq_questions WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([':id' => $_POST['id']]);
                break;
        }
    }
}

// Get categories for the dropdown
$categories = $db->query("SELECT id, name FROM faq_categories ORDER BY sort_order")->fetchAll(PDO::FETCH_ASSOC);

// Get FAQ questions
$questions = $db->query("SELECT q.*, c.name as category_name 
                        FROM faq_questions q 
                        LEFT JOIN faq_categories c ON q.category_id = c.id 
                        ORDER BY q.sort_order")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- TinyMCE Editor Script -->
<script src="https://cdn.tiny.cloud/1/eg5h3b2oiapcqpwui4blw8jut0y0aecadervw3z1b1bya6bx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="admin-header">
    <h2>FAQ Fragen verwalten</h2>
    <button onclick="openModal()" class="add-btn">Neue Frage</button>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Kategorie</th>
            <th>Frage</th>
            <th>Sortierung</th>
            <th>Aktionen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $question): ?>
        <tr>
            <td><?= htmlspecialchars($question['id']) ?></td>
            <td><?= htmlspecialchars($question['category_name']) ?></td>
            <td><?= htmlspecialchars($question['question']) ?></td>
            <td><?= htmlspecialchars($question['sort_order']) ?></td>
            <td>
                <button onclick="editQuestion(<?= htmlspecialchars(json_encode($question)) ?>)" class="edit-btn">Bearbeiten</button>
                <form method="post" style="display: inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $question['id'] ?>">
                    <button type="submit" onclick="return confirm('Wirklich löschen?')" class="delete-btn">Löschen</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div id="formModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3 id="modalTitle">Frage hinzufügen</h3>
        
        <form method="post" class="add-form">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="id" value="">
            
            <div class="form-group">
                <label>Kategorie:</label>
                <select name="category_id" required>
                    <option value="">Bitte wählen</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Frage:</label>
                <input type="text" name="question" required>
            </div>
            <div class="form-group">
                <label>Kurze Antwort:</label>
                <textarea name="answer_short" required></textarea>
            </div>
            <div class="form-group">
                <label>Ausführliche Antwort:</label>
                <textarea id="answer_extended" name="answer_extended"></textarea>
            </div>
            <div class="form-group">
                <label>Sortierung:</label>
                <input type="number" name="sort_order" value="0">
            </div>
            <div class="button-group">
                <button type="submit" class="submit-btn">Hinzufügen</button>
                <button type="button" onclick="closeModal()" class="cancel-btn">Abbrechen</button>
            </div>
        </form>
    </div>
</div>

<script>
const modal = document.getElementById('formModal');
const span = document.getElementsByClassName('close')[0];

// Initialize TinyMCE when modal opens
function initTinyMCE() {
    if (tinymce.get('answer_extended')) {
        tinymce.remove('#answer_extended');
    }
    
    return tinymce.init({
        selector: '#answer_extended',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 400,
        language: 'de',
        relative_urls: true,
        document_base_url: '<?= SITE_URL ?>',
        entity_encoding: 'raw',
        image_class_list: [
            {title: 'Responsive', value: 'img-fluid'}
        ],
        setup: function(editor) {
            editor.on('init', function() {
                editor.getContainer().style.transition = "opacity 0.3s ease-in-out";
            });
        }
    });
}

async function openModal() {
    // Clear the form completely
    const form = document.querySelector('.add-form');
    form.reset();
    document.querySelector('[name="action"]').value = 'create';
    document.querySelector('[name="id"]').value = '';
    document.querySelector('.submit-btn').textContent = 'Hinzufügen';
    document.getElementById('modalTitle').textContent = 'Frage hinzufügen';
    
    modal.style.display = 'block';
    await initTinyMCE();
}

async function closeModal() {
    if (tinymce.get('answer_extended')) {
        tinymce.remove('#answer_extended');
    }
    modal.style.display = 'none';
    resetForm();
}

span.onclick = closeModal;

window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}

async function editQuestion(question) {
    // First show the modal and initialize TinyMCE
    modal.style.display = 'block';
    await initTinyMCE();
    
    // Then set all the form values
    document.getElementById('modalTitle').textContent = 'Frage bearbeiten';
    
    // Set the form values
    const form = document.querySelector('.add-form');
    form.querySelector('[name="action"]').value = 'update';
    form.querySelector('[name="id"]').value = question.id;
    form.querySelector('[name="category_id"]').value = question.category_id;
    form.querySelector('[name="question"]').value = question.question;
    form.querySelector('[name="answer_short"]').value = question.answer_short;
    form.querySelector('[name="sort_order"]').value = question.sort_order;
    
    // Set TinyMCE content
    tinymce.get('answer_extended').setContent(question.answer_extended || '');
    
    form.querySelector('.submit-btn').textContent = 'Speichern';
}

function resetForm() {
    const form = document.querySelector('.add-form');
    form.reset();
    form.querySelector('[name="action"]').value = 'create';
    form.querySelector('[name="id"]').value = '';
    form.querySelector('.submit-btn').textContent = 'Hinzufügen';
    
    if (tinymce.get('answer_extended')) {
        tinymce.get('answer_extended').setContent('');
    }
}

// Add escape key handler
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && modal.style.display === 'block') {
        closeModal();
    }
});

// Update the form submit handler
document.querySelector('.add-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formAction = this.querySelector('[name="action"]').value;
    const formId = this.querySelector('[name="id"]').value;
    
    // Validate the form state
    if (formAction === 'update' && !formId) {
        alert('Fehler: Keine ID für das Update gefunden');
        return;
    }
    
    // Get the TinyMCE content
    const editor = tinymce.get('answer_extended');
    if (editor) {
        const content = editor.getContent();
        if (!content) {
            alert('Bitte geben Sie eine ausführliche Antwort ein.');
            return;
        }
        this.querySelector('[name="answer_extended"]').value = content;
    }
    
    // Validate other required fields
    const requiredFields = this.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('invalid');
        } else {
            field.classList.remove('invalid');
        }
    });
    
    if (!isValid) {
        alert('Bitte füllen Sie alle erforderlichen Felder aus.');
        return;
    }
    
    // Submit the form
    this.submit();
});
</script> 