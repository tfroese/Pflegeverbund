<?php
$db = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $sql = "INSERT INTO faq_categories (name, sort_order) VALUES (:name, :sort_order)";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':name' => $_POST['name'],
                    ':sort_order' => $_POST['sort_order'] ?? 0
                ]);
                break;

            case 'update':
                if (!isset($_POST['id'])) {
                    die('Error: No ID provided for update');
                }

                $sql = "UPDATE faq_categories SET name = :name, sort_order = :sort_order WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':name' => $_POST['name'],
                    ':sort_order' => $_POST['sort_order'] ?? 0,
                    ':id' => $_POST['id']
                ]);
                break;

            case 'delete':
                if (!isset($_POST['id'])) {
                    die('Error: No ID provided for deletion');
                }
                $sql = "DELETE FROM faq_categories WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute([':id' => $_POST['id']]);
                break;
        }
    }
}

// Get categories
$categories = $db->query("SELECT * FROM faq_categories ORDER BY sort_order")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="admin-header">
    <h2>FAQ-Kategorien verwalten</h2>
    <button onclick="openModal()" class="add-btn">Neue Kategorie</button>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Sortierung</th>
            <th>Aktionen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= htmlspecialchars($category['id']) ?></td>
            <td><?= htmlspecialchars($category['name']) ?></td>
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

async function openModal() {
    // Clear the form completely
    const form = document.querySelector('.add-form');
    form.reset();
    document.querySelector('[name="action"]').value = 'create';
    document.querySelector('[name="id"]').value = '';
    document.querySelector('.submit-btn').textContent = 'Hinzufügen';
    document.getElementById('modalTitle').textContent = 'Kategorie hinzufügen';
    
    modal.style.display = 'block';
}

async function closeModal() {
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
    // Then set all the form values
    document.getElementById('modalTitle').textContent = 'Kategorie bearbeiten';
    
    // Set the form values
    const form = document.querySelector('.add-form');
    form.querySelector('[name="action"]').value = 'update';
    form.querySelector('[name="id"]').value = category.id;
    form.querySelector('[name="name"]').value = category.name;
    form.querySelector('[name="sort_order"]').value = category.sort_order;
    
    form.querySelector('.submit-btn').textContent = 'Speichern';
    modal.style.display = 'block';
}

function resetForm() {
    const form = document.querySelector('.add-form');
    form.reset();
    form.querySelector('[name="action"]').value = 'create';
    form.querySelector('[name="id"]').value = '';
    form.querySelector('.submit-btn').textContent = 'Hinzufügen';
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
    
    // Validate required fields
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