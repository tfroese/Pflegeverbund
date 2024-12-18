-- Create database
CREATE DATABASE IF NOT EXISTS pflegeverbund CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pflegeverbund;

-- Create categories table
CREATE TABLE faq_categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    parent_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES faq_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Create questions table
CREATE TABLE faq_questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES faq_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

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

-- Insert questions for Pflegegrad Allgemein
INSERT INTO faq_questions (category_id, question, answer) VALUES
(1, 'Welche Pflegegrad steht mir zu?', 'Lorem Ipsum'),
(1, 'Ist der Service von Pflegeverbund kostenlos?', 'Ja der Dienst der Beratung ist vollkommen kostenlos.');

-- Insert questions for Pflegegrade
INSERT INTO faq_questions (category_id, question, answer) VALUES
(3, 'Wie Wechsel ich von Pflegegrad 1 auf Pflegegrad 2?', 'Lorem Ipsum'),
(4, 'Wie Wechsel ich von Pflegegrad 2 auf Pflegegrad 3?', 'Lorem Ipsum'),
(5, 'Wie Wechsel ich von Pflegegrad 3 auf Pflegegrad 4?', 'Lorem Ipsum'),
(6, 'Wie Wechsel ich von Pflegegrad 4 auf Pflegegrad 5?', 'Lorem Ipsum');

-- Insert questions for Pflegeberatung
INSERT INTO faq_questions (category_id, question, answer) VALUES
(2, 'Was ist die Pflichtberatung nach § 37.3 SGB XI und wer muss sie durchführen?', 'Personen, die Pflegegeld beziehen und von Angehörigen oder anderen privat organisiert gepflegt werden, sind verpflichtet, regelmäßige Beratungen nach § 37.3 SGB XI durchzuführen. - Pflegegrade 2 und 3: halbjährlich. - Pflegegrade 4 und 5: vierteljährlich. Die Beratung kann durch einen ambulanten Pflegedienst oder eine anerkannte Beratungsstelle erfolgen. Ab dem 1. April 2023 darf die Folgeberatung bequem per Videocall durchgeführt werden, allerdings muss die **Erstberatung zwingend persönlich zu Hause** stattfinden. Diese Regelung gilt vorerst bis zum 31. März 2027.'),
(2, 'Wird ein Hausnotruf von der Pflegekasse finanziert?', 'Ja, der Hausnotruf wird bei einem anerkannten Pflegegrad vollständig von der Pflegekasse finanziert. Die pflegebedürftige Person trägt keine zusätzlichen Kosten. Der Notrufknopf ermöglicht eine schnelle Hilfe im Notfall und trägt zur Sicherheit im Alltag bei.'),
(2, 'Welche Pflegehilfsmittel können über die Pflegekasse bezogen werden?', 'Über die Pflegekasse können Pflegehilfsmittel wie Einmalhandschuhe, Desinfektionsmittel oder Bettschutzeinlagen bis zu einem Wert von 40 Euro pro Monat kostenlos bezogen werden.');