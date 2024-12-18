-- Insert main categories
INSERT INTO faq_categories (name, parent_id) VALUES
('Pflegegrad Allgemein', NULL),
('Pflegeberatung', NULL);

-- Insert subcategories for Pflegegrad
INSERT INTO faq_categories (name, parent_id) VALUES
('Pflegegrad 1', 1),
('Pflegegrad 2', 1),
('Pflegegrad 3', 1),
('Pflegegrad 4', 1),
('Pflegegrad 5', 1);