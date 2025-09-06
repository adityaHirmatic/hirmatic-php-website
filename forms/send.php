<?php
require_once 'config.php';

// Basic email sending function
function sendEmail($to, $subject, $body, $attachmentPath = null) {
    $headers = array(
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . FROM_NAME . ' <' . FROM_EMAIL . '>',
        'Reply-To: ' . FROM_EMAIL,
        'X-Mailer: PHP/' . phpversion()
    );
    
    return mail($to, $subject, $body, implode("\r\n", $headers));
}

function send_contact_form($name, $email, $mobile, $message) {
    $subject = "New Contact Form Submission - " . $name;
    
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: linear-gradient(135deg, #FF5722, #4CAF50); color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .info-box { background: #f9f9f9; padding: 15px; border-left: 4px solid #FF5722; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>New Contact Form Submission</h2>
        </div>
        <div class='content'>
            <h3>Contact Details:</h3>
            <div class='info-box'>
                <strong>Name:</strong> {$name}<br>
                <strong>Email:</strong> {$email}<br>
                <strong>Mobile:</strong> {$mobile}
            </div>
            
            <h3>Message:</h3>
            <div class='info-box'>
                {$message}
            </div>
            
            <p><strong>Action Required:</strong> Please respond within 24 hours.</p>
        </div>
    </body>
    </html>";
    
    // Send to admin
    sendEmail(ADMIN_EMAIL, $subject, $body);
    
    // Send confirmation
    $confirmationSubject = "We received your message - HirMatic";
    $confirmationBody = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: linear-gradient(135deg, #FF5722, #4CAF50); color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>Thank You for Contacting Us!</h2>
        </div>
        <div class='content'>
            <p>Dear {$name},</p>
            
            <p>Thank you for reaching out to HirMatic. We have received your message and our team will respond within 24 hours.</p>
            
            <p>In the meantime, explore our resources:</p>
            <ul>
                <li><a href='" . SITE_URL . "/blog.php'>Latest recruitment insights</a></li>
                <li><a href='" . SITE_URL . "/resume.php'>Free AI resume analysis</a></li>
                <li><a href='" . SITE_URL . "/careers.php'>Career opportunities</a></li>
            </ul>
            
            <p>Best regards,<br>
            The HirMatic Team</p>
        </div>
    </body>
    </html>";
    
    return sendEmail($email, $confirmationSubject, $confirmationBody);
}

function send_employer_form($name, $email, $mobile, $company, $jobDescription) {
    $subject = "New Employer Inquiry from " . $name;
    
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: linear-gradient(135deg, #FF5722, #4CAF50); color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .info-box { background: #f9f9f9; padding: 15px; border-left: 4px solid #FF5722; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>🦈 New Employer Consultation Request</h2>
        </div>
        <div class='content'>
            <h3>Contact Information:</h3>
            <div class='info-box'>
                <strong>Name:</strong> {$name}<br>
                <strong>Email:</strong> {$email}<br>
                <strong>Mobile:</strong> {$mobile}<br>
                <strong>Company:</strong> {$company}
            </div>
            
            <h3>Hiring Requirements:</h3>
            <div class='info-box'>
                {$jobDescription}
            </div>
            
            <p><strong>Action Required:</strong> Please respond within 24 hours with a customized recruitment strategy.</p>
        </div>
    </body>
    </html>";
    
    // Send to admin
    sendEmail(ADMIN_EMAIL, $subject, $body);
    
    // Send confirmation to employer
    $confirmationSubject = "Thank you for your inquiry - HirMatic";
    $confirmationBody = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: linear-gradient(135deg, #FF5722, #4CAF50); color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>Thank You for Contacting HirMatic!</h2>
        </div>
        <div class='content'>
            <p>Dear {$name},</p>
            
            <p>Thank you for your interest in HirMatic's AI-powered recruitment solutions. We have received your consultation request and our team is already reviewing your requirements.</p>
            
            <p><strong>What happens next:</strong></p>
            <ul>
                <li>Our recruitment specialists will analyze your hiring needs</li>
                <li>We'll prepare a customized strategy within 24 hours</li>
                <li>You'll receive a detailed proposal via email</li>
                <li>We'll schedule a consultation call at your convenience</li>
            </ul>
            
            <p>Best regards,<br>
            The HirMatic Team<br>
            🦈 AI-driven Recruitment That Feels Effortless</p>
        </div>
    </body>
    </html>";
    
    return sendEmail($email, $confirmationSubject, $confirmationBody);
}

// Utility function to clean input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
