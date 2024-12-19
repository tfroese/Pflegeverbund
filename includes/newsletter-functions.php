<?php
require_once 'database.php';
require_once 'email-functions.php';

function subscribeToNewsletter($email) {
    $db = getDbConnection();
    
    // Check if email already exists
    $stmt = $db->prepare('SELECT * FROM newsletter_subscribers WHERE email = ?');
    $stmt->execute([$email]);
    $subscriber = $stmt->fetch();
    
    if ($subscriber) {
        if ($subscriber['is_verified']) {
            return ['error' => 'Diese E-Mail-Adresse ist bereits registriert'];
        } else {
            // Resend verification email
            sendVerificationEmail($email, $subscriber['verification_token']);
            return ['success' => true, 'message' => 'Bestätigungs-E-Mail wurde erneut gesendet'];
        }
    }
    
    // Generate tokens
    $verificationToken = bin2hex(random_bytes(32));
    $unsubscribeToken = bin2hex(random_bytes(32));
    
    // Insert new subscriber
    $stmt = $db->prepare('
        INSERT INTO newsletter_subscribers 
        (email, verification_token, unsubscribe_token, ip_address, consent_date) 
        VALUES (?, ?, ?, ?, NOW())
    ');
    
    $stmt->execute([
        $email,
        $verificationToken,
        $unsubscribeToken,
        $_SERVER['REMOTE_ADDR']
    ]);
    
    $subscriberId = $db->lastInsertId();
    
    // Log consent
    logNewsletterAction($subscriberId, 'subscribe');
    
    // Send verification email
    sendVerificationEmail($email, $verificationToken);
    
    return [
        'success' => true,
        'message' => 'Bitte bestätigen Sie Ihre E-Mail-Adresse. Eine Bestätigungs-E-Mail wurde gesendet.'
    ];
}

function verifyNewsletter($token) {
    $db = getDbConnection();
    
    $stmt = $db->prepare('
        SELECT id, email 
        FROM newsletter_subscribers 
        WHERE verification_token = ? AND is_verified = 0
    ');
    $stmt->execute([$token]);
    $subscriber = $stmt->fetch();
    
    if (!$subscriber) {
        return ['error' => 'Ungültiger oder bereits verwendeter Bestätigungslink'];
    }
    
    // Update subscriber
    $stmt = $db->prepare('
        UPDATE newsletter_subscribers 
        SET is_verified = 1, verified_date = NOW(), verification_token = NULL 
        WHERE id = ?
    ');
    $stmt->execute([$subscriber['id']]);
    
    // Log verification
    logNewsletterAction($subscriber['id'], 'verify');
    
    return ['success' => true];
}

function unsubscribeFromNewsletter($token) {
    $db = getDbConnection();
    
    $stmt = $db->prepare('SELECT id FROM newsletter_subscribers WHERE unsubscribe_token = ?');
    $stmt->execute([$token]);
    $subscriber = $stmt->fetch();
    
    if (!$subscriber) {
        return ['error' => 'Ungültiger Abmeldelink'];
    }
    
    // Log unsubscribe before deleting
    logNewsletterAction($subscriber['id'], 'unsubscribe');
    
    // Delete subscriber
    $stmt = $db->prepare('DELETE FROM newsletter_subscribers WHERE id = ?');
    $stmt->execute([$subscriber['id']]);
    
    return ['success' => true];
}

function logNewsletterAction($subscriberId, $actionType) {
    $db = getDbConnection();
    
    $stmt = $db->prepare('
        INSERT INTO newsletter_consent_log 
        (subscriber_id, action_type, ip_address, user_agent) 
        VALUES (?, ?, ?, ?)
    ');
    
    $stmt->execute([
        $subscriberId,
        $actionType,
        $_SERVER['REMOTE_ADDR'],
        $_SERVER['HTTP_USER_AGENT']
    ]);
}

function sendVerificationEmail($email, $token) {
    $verifyUrl = SITE_URL . '/api/newsletter-verify.php?token=' . $token;
    
    $subject = 'Bestätigen Sie Ihre Newsletter-Anmeldung';
    $message = "
        Sehr geehrte/r Newsletter-Abonnent/in,
        
        vielen Dank für Ihre Anmeldung zu unserem Newsletter.
        
        Um Ihre E-Mail-Adresse zu bestätigen, klicken Sie bitte auf folgenden Link:
        {$verifyUrl}
        
        Wenn Sie sich nicht für unseren Newsletter angemeldet haben, können Sie diese E-Mail ignorieren.
        
        Mit freundlichen Grüßen
        Ihr Pflegeverbund-Team
    ";
    
    return sendEmail($email, $subject, $message);
}