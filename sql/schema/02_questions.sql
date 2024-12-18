-- Create questions table
CREATE TABLE IF NOT EXISTS faq_questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES faq_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;