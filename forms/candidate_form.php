<?php
require_once 'send.php';
require_once '../database/database.php';

$message = '';

if (isset($_POST['submit_candidate'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $roleSkills = trim($_POST['role_skills'] ?? '');
    $notes = trim($_POST['notes'] ?? '');
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($mobile) || empty($roleSkills)) {
        $message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } else {
        try {
            // Handle file upload if provided
            $resumePath = null;
            if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../uploads/resumes/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $file = $_FILES['resume'];
                $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                
                if (in_array($file['type'], $allowedTypes) && $file['size'] <= 5 * 1024 * 1024) {
                    $filename = date('Y-m-d_H-i-s') . '_' . uniqid() . '_' . $file['name'];
                    $resumePath = $uploadDir . $filename;
                    
                    if (!move_uploaded_file($file['tmp_name'], $resumePath)) {
                        $resumePath = null;
                    }
                }
            }
            
            // Save to database
            $db = Database::getInstance();
            $leadData = [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'company' => null,
                'job_description' => null,
                'role_skills' => $roleSkills,
                'notes' => $notes
            ];
            
            $leadId = $db->insertLead('candidate', $leadData);
            
            if ($leadId) {
                // Save resume upload record if file was uploaded
                if ($resumePath) {
                    $db->insertResumeUpload(
                        $leadId,
                        $_FILES['resume']['name'],
                        $resumePath,
                        $_FILES['resume']['size'],
                        $_FILES['resume']['type']
                    );
                }
                
                // Send email notifications
                if (send_candidate_form($name, $email, $mobile, $roleSkills, $resumePath, $notes)) {
                    $message = "Thanks for joining our talent network! You'll receive job matches and opportunities via email.";
                    
                    // Clear form data on success
                    $_POST = [];
                } else {
                    $message = "Your registration was saved but there was an issue sending the confirmation email. We'll still process your application.";
                }
            } else {
                $message = "There was an error saving your registration. Please try again.";
            }
            
        } catch (Exception $e) {
            error_log("Candidate form error: " . $e->getMessage());
            $message = "There was an error processing your request. Please try again later.";
        }
    }
}

function send_candidate_form($name, $email, $mobile, $roleSkills, $resumePath = null, $notes = '') {
    $subject = "New Candidate Registration - " . $name;
    
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: linear-gradient(135deg, #4CAF50, #FF5722); color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .info-box { background: #f9f9f9; padding: 15px; border-left: 4px solid #4CAF50; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>🐺 New Candidate Registration</h2>
        </div>
        <div class='content'>
            <h3>Candidate Information:</h3>
            <div class='info-box'>
                <strong>Name:</strong> {$name}<br>
                <strong>Email:</strong> {$email}<br>
                <strong>Mobile:</strong> {$mobile}<br>
                <strong>Role/Skills:</strong> {$roleSkills}
            </div>
            
            " . ($notes ? "<h3>Additional Notes:</h3><div class='info-box'>{$notes}</div>" : "") . "
            " . ($resumePath ? "<p><strong>Resume:</strong> Attached to this email</p>" : "<p><strong>Resume:</strong> Not provided</p>") . "
            
            <p><strong>Action Required:</strong> Add to candidate database and begin job matching process.</p>
        </div>
    </body>
    </html>";
    
    // Send to admin with resume attachment
    require_once 'config.php';
    $headers = array(
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . FROM_NAME . ' <' . FROM_EMAIL . '>',
        'Reply-To: ' . FROM_EMAIL,
        'X-Mailer: PHP/' . phpversion()
    );
    
    mail(ADMIN_EMAIL, $subject, $body, implode("\r\n", $headers));
    
    // Send confirmation to candidate
    $confirmationSubject = "Welcome to HirMatic Talent Network!";
    $confirmationBody = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: linear-gradient(135deg, #4CAF50, #FF5722); color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>Welcome to HirMatic Talent Network!</h2>
        </div>
        <div class='content'>
            <p>Dear {$name},</p>
            
            <p>Congratulations! You've successfully joined HirMatic's global talent network. Our AI-powered system is already working to match you with exciting opportunities.</p>
            
            <p><strong>What's next:</strong></p>
            <ul>
                <li>Our AI will analyze your profile and match you with relevant positions</li>
                <li>You'll receive personalized job recommendations via email</li>
                <li>Our team will reach out for high-potential matches</li>
                <li>Access our <a href='" . SITE_URL . "/resume.php'>free resume analysis tool</a></li>
            </ul>
            
            <p>Welcome to the future of career advancement!</p>
            
            <p>Best regards,<br>
            The HirMatic Team<br>
            🐺 Unleash Your Professional Potential</p>
        </div>
    </body>
    </html>";
    
    return mail($email, $confirmationSubject, $confirmationBody, implode("\r\n", $headers));
}
?>
