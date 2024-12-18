CREATE TABLE IF NOT EXISTS guides (
    id INT PRIMARY KEY AUTO_INCREMENT,
    headline VARCHAR(255) NOT NULL,
    subheadline TEXT,
    image_path VARCHAR(255),
    content TEXT NOT NULL,
    link VARCHAR(255) NOT NULL,
    published_on DATETIME NOT NULL,
    updated_on DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_published_on (published_on),
    INDEX idx_updated_on (updated_on),
    UNIQUE INDEX idx_link (link)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;