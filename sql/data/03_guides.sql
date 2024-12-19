-- Insert guide categories first
INSERT INTO guide_categories (name, description, slug, sort_order) VALUES
('Pflegegrade', 'Informationen rund um Pflegegrade und deren Beantragung', 'pflegegrade', 10),
('Pflegehilfsmittel', 'Alles über Pflegehilfsmittel und deren Finanzierung', 'pflegehilfsmittel', 20),
('Häusliche Pflege', 'Ratgeber für die Pflege zu Hause', 'haeusliche-pflege', 30),
('Rechtliches', 'Rechtliche Aspekte der Pflege', 'rechtliches', 40),
('Finanzierung', 'Informationen zur Finanzierung der Pflege', 'finanzierung', 50);

-- Insert guides for "Pflegegrade" category
INSERT INTO guides (category_id, headline, subheadline, image_path, content, link, sort_order, published_on, updated_on)
SELECT 
    c.id,
    'Pflegegrad beantragen: Schritt für Schritt Anleitung',
    'Erfahren Sie, wie Sie einen Pflegegrad erfolgreich beantragen können',
    '/images/guides/pflegegrad-beantragen.jpg',
    '<p>Ein Pflegegrad ist die Voraussetzung für Leistungen aus der Pflegeversicherung. Hier erfahren Sie, wie Sie den Antrag richtig stellen.</p>
    <h2>Wer kann einen Pflegegrad beantragen?</h2>
    <p>Jeder, der aufgrund gesundheitlicher Beeinträchtigungen Hilfe im Alltag benötigt, kann einen Pflegegrad beantragen.</p>
    <h2>Wie läuft die Antragstellung ab?</h2>
    <p>1. Kontaktieren Sie Ihre Pflegekasse<br>2. Füllen Sie den Antrag aus<br>3. Warten Sie auf den Besuch des MDK</p>',
    'pflegegrad-beantragen-schritt-fuer-schritt-anleitung',
    10,
    '2024-01-15 10:00:00',
    '2024-01-15 10:00:00'
FROM guide_categories c 
WHERE c.slug = 'pflegegrade';

INSERT INTO guides (category_id, headline, subheadline, image_path, content, link, sort_order, published_on, updated_on)
SELECT 
    c.id,
    'Die 5 Pflegegrade im Überblick',
    'Alle wichtigen Informationen zu den verschiedenen Pflegegraden',
    '/images/guides/pflegegrade-ueberblick.jpg',
    '<p>Die Pflegeversicherung unterscheidet fünf Pflegegrade. Je höher der Pflegegrad, desto mehr Unterstützung wird benötigt.</p>
    <h2>Pflegegrad 1</h2>
    <p>Geringe Beeinträchtigungen der Selbstständigkeit</p>
    <h2>Pflegegrad 2</h2>
    <p>Erhebliche Beeinträchtigungen der Selbstständigkeit</p>',
    'die-5-pflegegrade-im-ueberblick',
    20,
    '2024-01-20 09:00:00',
    '2024-01-20 09:00:00'
FROM guide_categories c 
WHERE c.slug = 'pflegegrade';

-- Insert guides for "Pflegehilfsmittel" category
INSERT INTO guides (category_id, headline, subheadline, image_path, content, link, sort_order, published_on, updated_on)
SELECT 
    c.id,
    'Pflegehilfsmittel: Was wird von der Kasse bezahlt?',
    'Übersicht über kostenlose und bezuschusste Pflegehilfsmittel',
    '/images/guides/pflegehilfsmittel.jpg',
    '<p>Die Pflegekasse übernimmt die Kosten für viele Hilfsmittel, die die Pflege erleichtern.</p>
    <h2>Technische Hilfsmittel</h2>
    <p>Pflegebetten, Lifter, Notrufsysteme</p>
    <h2>Verbrauchsmittel</h2>
    <p>Einmalhandschuhe, Desinfektionsmittel, Betteinlagen</p>',
    'pflegehilfsmittel-was-wird-von-der-kasse-bezahlt',
    10,
    '2024-01-25 14:30:00',
    '2024-02-01 09:15:00'
FROM guide_categories c 
WHERE c.slug = 'pflegehilfsmittel';

-- Insert guides for "Häusliche Pflege" category
INSERT INTO guides (category_id, headline, subheadline, image_path, content, link, sort_order, published_on, updated_on)
SELECT 
    c.id,
    'Tipps für pflegende Angehörige',
    'So meistern Sie den Pflegealltag',
    '/images/guides/tipps-pflegende-angehoerige.jpg',
    '<p>Die Pflege von Angehörigen ist eine herausfordernde Aufgabe. Mit diesen Tipps wird sie leichter.</p>
    <h2>Selbstpflege nicht vergessen</h2>
    <p>Achten Sie auch auf Ihre eigenen Bedürfnisse</p>
    <h2>Hilfe annehmen</h2>
    <p>Nutzen Sie Unterstützungsangebote</p>',
    'tipps-fuer-pflegende-angehoerige',
    10,
    '2024-02-01 11:00:00',
    '2024-02-01 11:00:00'
FROM guide_categories c 
WHERE c.slug = 'haeusliche-pflege';

-- Insert guides for "Rechtliches" category
INSERT INTO guides (category_id, headline, subheadline, image_path, content, link, sort_order, published_on, updated_on)
SELECT 
    c.id,
    'Vorsorgevollmacht und Patientenverfügung',
    'Wichtige Dokumente für den Ernstfall',
    '/images/guides/vorsorgevollmacht.jpg',
    '<p>Mit einer Vorsorgevollmacht und Patientenverfügung regeln Sie wichtige Entscheidungen im Voraus.</p>
    <h2>Vorsorgevollmacht</h2>
    <p>Bestimmen Sie, wer Entscheidungen für Sie treffen darf</p>
    <h2>Patientenverfügung</h2>
    <p>Legen Sie medizinische Behandlungswünsche fest</p>',
    'vorsorgevollmacht-und-patientenverfuegung',
    10,
    '2024-02-05 15:30:00',
    '2024-02-05 15:30:00'
FROM guide_categories c 
WHERE c.slug = 'rechtliches';

-- Insert guides for "Finanzierung" category
INSERT INTO guides (category_id, headline, subheadline, image_path, content, link, sort_order, published_on, updated_on)
SELECT 
    c.id,
    'Leistungen der Pflegeversicherung',
    'Welche finanziellen Hilfen stehen Ihnen zu?',
    '/images/guides/pflegeleistungen.jpg',
    '<p>Die Pflegeversicherung bietet verschiedene finanzielle Unterstützungsmöglichkeiten.</p>
    <h2>Pflegegeld</h2>
    <p>Für die Pflege durch Angehörige</p>
    <h2>Pflegesachleistungen</h2>
    <p>Für professionelle Pflegedienste</p>',
    'leistungen-der-pflegeversicherung',
    10,
    '2024-02-10 09:45:00',
    '2024-02-10 09:45:00'
FROM guide_categories c 
WHERE c.slug = 'finanzierung';