<?php
function sendEmail($to, $subject, $message) {
    // Email headers
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: Pflegeverbund <noreply@pflegeverbund.de>',
        'Reply-To: info@pflegeverbund.de',
        'X-Mailer: PHP/' . phpversion()
    ];

    // Convert plain text to HTML
    $htmlMessage = nl2br(htmlspecialchars($message));
    
    // Create HTML email template
    $htmlEmail = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$subject}</title>
    </head>
    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;'>
        {$htmlMessage}
        <hr style='margin: 20px 0; border: none; border-top: 1px solid #eee;'>
        <p style='font-size: 12px; color: #666;'>
            Diese E-Mail wurde von Pflegeverbund.de gesendet.<br>
            Falls Sie diese E-Mail fälschlicherweise erhalten haben, löschen Sie sie bitte.
        </p>
    </body>
    </html>
    ";

    // Send email
    return mail($to, $subject, $htmlEmail, implode("\r\n", $headers));
}