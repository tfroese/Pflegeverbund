-- Create categories table
CREATE TABLE IF NOT EXISTS faq_categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    parent_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES faq_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;