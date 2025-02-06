<?php
$db = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                // Check if slug already exists
                $checkSql = "SELECT id FROM guide_categories WHERE slug = :slug";
                $checkStmt = $db->prepare($checkSql);
                $checkStmt->execute([':slug' => $_POST['slug']]);
                if ($checkStmt->fetch()) {
                    die('Error: Eine Kategorie mit diesem Slug existiert bereits.');
                }

                $sql = "INSERT INTO guide_categories (name, description, slug, sort_order) 
                        VALUES (:name, :description, :slug, :sort_order)";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':name' => $_POST['name'],
                    ':description' => $_POST['description'] ?? '',
                    ':slug' => $_POST['slug'],
                    ':sort_order' => $_POST['sort_order'] ?? 0
                ]);
                break;

            case 'update':
                if (!isset($_POST['id'])) {
                    die('Error: No ID provided for update');
                }

                // Check if slug already exists for other entries
                $checkSql = "SELECT id FROM guide_categories WHERE slug = :slug AND id != :id";
                $checkStmt = $db->prepare($checkSql);
                $checkStmt->execute([
                    ':slug' => $_POST['slug'],
                    ':id' => $_POST['id']
                ]);
                if ($checkStmt->fetch()) {
                    die('Error: Eine andere Kategorie verwendet bereits diesen Slug.');
                }

                $sql = "UPDATE guide_categories SET 
                        name = :name, 
                        description = :description, 
                        slug = :slug, 
                        sort_order = :sort_order 
                        WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':name' => $_POST['name'],
                    ':description' => $_POST['description'] ?? '',
                    ':slug' => $_POST['slug'],
                    ':sort_order' => $_POST['sort_order'] ?? 0,
                    ':id' => $_POST['id']
                ]);
                break;

            case 'delete':
                if (!isset($_POST['id'])) {
                    die('Error: No ID provided for deletion');
                }
                $sql = "DELETE FROM guide_categories WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([':id' => $_POST['id']]);
                break;
        }
    }
}

// Get categories
$categories = $db->query("SELECT * FROM guide_categories ORDER BY sort_order")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- TinyMCE Editor Script -->
<script src="https://cdn.tiny.cloud/1/eg5h3b2oiapcqpwui4blw8jut0y0aecadervw3z1b1bya6bx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="admin-header">
    <h2>Ratgeber-Kategorien verwalten</h2>
    <button onclick="openModal()" class="add-btn">Neue Kategorie</button>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Sortierung</th>
            <th>Aktionen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= htmlspecialchars($category['id']) ?></td>
            <td><?= htmlspecialchars($category['name']) ?></td>
            <td><?= htmlspecialchars($category['slug']) ?></td>
            <td><?= htmlspecialchars($category['sort_order']) ?></td>
            <td>
                <button onclick="editCategory(<?= htmlspecialchars(json_encode($category)) ?>)" class="edit-btn">Bearbeiten</button>
                <form method="post" style="display: inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
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
        <h3 id="modalTitle">Kategorie hinzufügen</h3>
        
        <form method="post" class="add-form">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="id" value="">
            
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Beschreibung:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label>Slug:</label>
                <input type="text" name="slug" required>
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
    if (tinymce.get('description')) {
        tinymce.remove('#description');
    }
    
    return tinymce.init({
        selector: '#description',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 300,
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
    document.getElementById('modalTitle').textContent = 'Kategorie hinzufügen';
    
    modal.style.display = 'block';
    await initTinyMCE();
}

async function closeModal() {
    if (tinymce.get('description')) {
        tinymce.remove('#description');
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

async function editCategory(category) {
    // First show the modal and initialize TinyMCE
    modal.style.display = 'block';
    await initTinyMCE();
    
    // Then set all the form values
    document.getElementById('modalTitle').textContent = 'Kategorie bearbeiten';
    
    // Set the form values
    const form = document.querySelector('.add-form');
    form.querySelector('[name="action"]').value = 'update';
    form.querySelector('[name="id"]').value = category.id;
    form.querySelector('[name="name"]').value = category.name;
    form.querySelector('[name="slug"]').value = category.slug;
    form.querySelector('[name="sort_order"]').value = category.sort_order;
    
    // Set TinyMCE content
    tinymce.get('description').setContent(category.description || '');
    
    form.querySelector('.submit-btn').textContent = 'Speichern';
}

function resetForm() {
    const form = document.querySelector('.add-form');
    form.reset();
    form.querySelector('[name="action"]').value = 'create';
    form.querySelector('[name="id"]').value = '';
    form.querySelector('.submit-btn').textContent = 'Hinzufügen';
    
    if (tinymce.get('description')) {
        tinymce.get('description').setContent('');
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
    const editor = tinymce.get('description');
    if (editor) {
        const content = editor.getContent();
        this.querySelector('[name="description"]').value = content;
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