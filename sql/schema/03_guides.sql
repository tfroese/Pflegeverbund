CREATE TABLE IF NOT EXISTS guide_categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    slug VARCHAR(255) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE INDEX idx_slug (slug),
    INDEX idx_sort_order (sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS guides (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL,
    headline VARCHAR(255) NOT NULL,
    subheadline TEXT,
    image_path VARCHAR(255),
    content TEXT NOT NULL,
    link VARCHAR(255) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    published_on DATETIME NOT NULL,
    updated_on DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_published_on (published_on),
    INDEX idx_updated_on (updated_on),
    INDEX idx_sort_order (sort_order),
    UNIQUE INDEX idx_link (link),
    FOREIGN KEY (category_id) REFERENCES guide_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;