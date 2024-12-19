<?php
require_once __DIR__ . '/../includes/database.php';

function executeSQLFile($pdo, $filepath) {
    try {
        // Read file content
        $sql = file_get_contents($filepath);
        if ($sql === false) {
            throw new Exception("Error reading file: $filepath");
        }

        // Split into individual statements
        $statements = array_filter(
            array_map(
                'trim',
                explode(';', $sql)
            ),
            'strlen'
        );

        // Execute each statement separately
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                $pdo->exec($statement);
            }
        }
        
        echo "Executed: $filepath\n";
    } catch (Exception $e) {
        die("Error executing $filepath: " . $e->getMessage() . "\n");
    }
}

try {
    // Create database if it doesn't exist
    $pdo = new PDO(
        "mysql:host=" . DB_HOST,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database created or already exists\n";
    
    // Connect to the specific database
    $pdo->exec("USE " . DB_NAME);
    
    // Drop existing tables in correct order (respect foreign keys)
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("DROP TABLE IF EXISTS guides");
    $pdo->exec("DROP TABLE IF EXISTS guide_categories");
    $pdo->exec("DROP TABLE IF EXISTS faq_questions");
    $pdo->exec("DROP TABLE IF EXISTS faq_categories");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "Existing tables dropped\n";
    
    // Schema files in correct order
    $schemaFiles = [
        __DIR__ . '/../sql/schema/01_faq_categories.sql',
        __DIR__ . '/../sql/schema/02_faq_questions.sql',
        __DIR__ . '/../sql/schema/03_guides.sql',
        __DIR__ . '/../sql/schema/04_newsletter.sql'
    ];
    
    // Data files in correct order
    $dataFiles = [
        __DIR__ . '/../sql/data/01_faq_categories.sql',
        __DIR__ . '/../sql/data/02_faq_questions.sql',
        __DIR__ . '/../sql/data/03_guides.sql'
    ];
    
    // Execute schema files
    echo "\nCreating schema...\n";
    foreach ($schemaFiles as $file) {
        executeSQLFile($pdo, $file);
    }
    
    // Execute data files
    echo "\nInserting demo data...\n";
    foreach ($dataFiles as $file) {
        executeSQLFile($pdo, $file);
    }
    
    echo "\nDemo data reset completed successfully!\n";
    
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage() . "\n");
}
?>