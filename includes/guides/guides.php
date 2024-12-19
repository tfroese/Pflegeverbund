<?php
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../utils/date.php';

function getPublishedGuidesByCategory($limit = null, $offset = 0) {
    $db = getDbConnection();
    $currentDate = date('Y-m-d H:i:s');
    
    $sql = "SELECT g.*, c.name as category_name, c.slug as category_slug 
            FROM guides g 
            JOIN guide_categories c ON g.category_id = c.id 
            WHERE g.published_on <= :current_date 
            ORDER BY c.sort_order ASC, c.name ASC, g.sort_order ASC, g.published_on DESC";
    
    if ($limit !== null) {
        $sql .= " LIMIT :limit OFFSET :offset";
    }
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':current_date', $currentDate);
    
    if ($limit !== null) {
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    $guides = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return groupGuidesByCategory($guides);
}

function getGuideBySlug($slug) {
    $db = getDbConnection();
    $currentDate = date('Y-m-d H:i:s');
    
    $sql = "SELECT g.*, c.name as category_name, c.slug as category_slug 
            FROM guides g 
            JOIN guide_categories c ON g.category_id = c.id 
            WHERE g.link = :slug 
            AND g.published_on <= :current_date";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':current_date', $currentDate);
    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateGuideOrder($id, $newOrder) {
    $db = getDbConnection();
    $sql = "UPDATE guides SET sort_order = :sort_order WHERE id = :id";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':sort_order' => $newOrder
    ]);
}

function groupGuidesByCategory($guides) {
    $guidesByCategory = [];
    foreach ($guides as $guide) {
        $categoryName = $guide['category_name'];
        if (!isset($guidesByCategory[$categoryName])) {
            $guidesByCategory[$categoryName] = [
                'slug' => $guide['category_slug'],
                'guides' => []
            ];
        }
        $guidesByCategory[$categoryName]['guides'][] = $guide;
    }
    return $guidesByCategory;
}