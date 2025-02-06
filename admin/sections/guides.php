<?php
$db = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                // Check if link already exists
                $checkSql = "SELECT id FROM guides WHERE link = :link";
                $checkStmt = $db->prepare($checkSql);
                $checkStmt->execute([':link' => $_POST['link']]);
                if ($checkStmt->fetch()) {
                    die('Error: Ein Ratgeber mit diesem Link existiert bereits.');
                }

                $sql = "INSERT INTO guides (category_id, headline, subheadline, image_path, content, link, sort_order, published_on, updated_on, visible) 
                        VALUES (:category_id, :headline, :subheadline, :image_path, :content, :link, :sort_order, NOW(), NOW(), :visible)";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':category_id' => $_POST['category_id'],
                    ':headline' => $_POST['headline'],
                    ':subheadline' => $_POST['subheadline'] ?? '',
                    ':image_path' => $_POST['image_path'] ?? '',
                    ':content' => $_POST['content'],
                    ':link' => $_POST['link'],
                    ':sort_order' => $_POST['sort_order'] ?? 0,
                    ':visible' => $_POST['visible'] ?? 1
                ]);
                break;
            case 'update':
                if (!isset($_POST['id'])) {
                    die('Error: No ID provided for update');
                }

                // Check if link already exists for other entries
                $checkSql = "SELECT id FROM guides WHERE link = :link AND id != :id";
                $checkStmt = $db->prepare($checkSql);
                $checkStmt->execute([
                    ':link' => $_POST['link'],
                    ':id' => $_POST['id']
                ]);
                if ($checkStmt->fetch()) {
                    die('Error: Ein anderer Ratgeber verwendet bereits diesen Link.');
                }

                $sql = "UPDATE guides SET 
                        category_id = :category_id, 
                        headline = :headline, 
                        subheadline = :subheadline, 
                        image_path = :image_path, 
                        content = :content, 
                        link = :link, 
                        sort_order = :sort_order, 
                        updated_on = NOW(), 
                        visible = :visible 
                        WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':category_id' => $_POST['category_id'],
                    ':headline' => $_POST['headline'],
                    ':subheadline' => $_POST['subheadline'] ?? '',
                    ':image_path' => $_POST['image_path'] ?? '',
                    ':content' => $_POST['content'],
                    ':link' => $_POST['link'],
                    ':sort_order' => $_POST['sort_order'] ?? 0,
                    ':visible' => $_POST['visible'] ?? 1,
                    ':id' => $_POST['id']
                ]);
                break;
            case 'delete':
                if (!isset($_POST['id'])) {
                    die('Error: No ID provided for deletion');
                }
                $sql = "DELETE FROM guides WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([':id' => $_POST['id']]);
                break;
        }
    }
}

// Get categories for the dropdown
$categories = $db->query("SELECT id, name FROM guide_categories ORDER BY sort_order")->fetchAll(PDO::FETCH_ASSOC);

// Get guides
$guides = $db->query("SELECT g.*, gc.name as category_name 
                      FROM guides g 
                      LEFT JOIN guide_categories gc ON g.category_id = gc.id 
                      ORDER BY g.sort_order")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="admin-header">
    <h2>Ratgeber verwalten</h2>
    <button onclick="openModal()" class="add-btn">Neuer Ratgeber</button>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Kategorie</th>
            <th>Überschrift</th>
            <th>Sortierung</th>
            <th>Sichtbar</th>
            <th>Aktionen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($guides as $guide): ?>
        <tr>
            <td><?= htmlspecialchars($guide['id']) ?></td>
            <td><?= htmlspecialchars($guide['category_name']) ?></td>
            <td><?= htmlspecialchars($guide['headline']) ?></td>
            <td><?= htmlspecialchars($guide['sort_order']) ?></td>
            <td><?= $guide['visible'] ? 'Ja' : 'Nein' ?></td>
            <td>
                <button onclick="editGuide(<?= htmlspecialchars(json_encode($guide)) ?>)" class="edit-btn">Bearbeiten</button>
                <form method="post" style="display: inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $guide['id'] ?>">
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
        <h3 id="modalTitle">Ratgeber hinzufügen</h3>
        
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
                <label>Überschrift:</label>
                <input type="text" name="headline" required>
            </div>
            <div class="form-group">
                <label>Unterüberschrift:</label>
                <input type="text" name="subheadline">
            </div>
            <div class="form-group">
                <label>Bild-Pfad:</label>
                <input type="text" name="image_path">
            </div>
            <div class="form-group">
                <label>Inhalt:</label>
                <textarea id="content" name="content"></textarea>
            </div>
            <div class="form-group">
                <label>Link:</label>
                <input type="text" name="link" required>
            </div>
            <div class="form-group">
                <label>Sortierung:</label>
                <input type="number" name="sort_order" value="0">
            </div>
            <div class="form-group">
                <label>Sichtbar:</label>
                <select name="visible">
                    <option value="1">Ja</option>
                    <option value="0">Nein</option>
                </select>
            </div>
            <div class="button-group">
                <button type="submit" class="submit-btn">Hinzufügen</button>
                <button type="button" onclick="closeModal()" class="cancel-btn">Abbrechen</button>
            </div>
        </form>
    </div>
</div>

<script>
// Declare functions in global scope
let modal;
let span;

function initTinyMCE() {
    if (tinymce.get('content')) {
        tinymce.remove('#content');
    }
    
    return tinymce.init({
        selector: '#content',
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
    document.getElementById('modalTitle').textContent = 'Ratgeber hinzufügen';
    
    modal.style.display = 'block';
    await initTinyMCE();
}

async function closeModal() {
    if (tinymce.get('content')) {
        tinymce.remove('#content');
    }
    modal.style.display = 'none';
    resetForm();
}

async function editGuide(guide) {
    // First show the modal and initialize TinyMCE
    modal.style.display = 'block';
    await initTinyMCE();
    
    // Then set all the form values
    document.getElementById('modalTitle').textContent = 'Ratgeber bearbeiten';
    
    // Set the form values
    const form = document.querySelector('.add-form');
    form.querySelector('[name="action"]').value = 'update';
    form.querySelector('[name="id"]').value = guide.id;
    form.querySelector('[name="category_id"]').value = guide.category_id;
    form.querySelector('[name="headline"]').value = guide.headline;
    form.querySelector('[name="subheadline"]').value = guide.subheadline || '';
    form.querySelector('[name="image_path"]').value = guide.image_path || '';
    form.querySelector('[name="link"]').value = guide.link;
    form.querySelector('[name="sort_order"]').value = guide.sort_order;
    form.querySelector('[name="visible"]').value = guide.visible;
    
    // Set TinyMCE content
    tinymce.get('content').setContent(guide.content || '');
    
    form.querySelector('.submit-btn').textContent = 'Speichern';
}

function resetForm() {
    const form = document.querySelector('.add-form');
    form.reset();
    form.querySelector('[name="action"]').value = 'create';
    form.querySelector('[name="id"]').value = '';
    form.querySelector('.submit-btn').textContent = 'Hinzufügen';
    
    if (tinymce.get('content')) {
        tinymce.get('content').setContent('');
    }
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    modal = document.getElementById('formModal');
    span = document.getElementsByClassName('close')[0];

    // Set up event listeners
    span.onclick = closeModal;

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
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
        const editor = tinymce.get('content');
        if (editor) {
            const content = editor.getContent();
            if (!content) {
                alert('Bitte geben Sie einen Inhalt ein.');
                return;
            }
            this.querySelector('[name="content"]').value = content;
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
});
</script> 