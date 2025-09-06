<?php
require_once 'send.php';
require_once '../database/database.php';

$message = '';

if (isset($_POST['submit_employer'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $jobDescription = trim($_POST['job_description'] ?? '');
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($mobile) || empty($company) || empty($jobDescription)) {
        $message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } else {
        try {
            // Save to database
            $db = Database::getInstance();
            $leadData = [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'company' => $company,
                'job_description' => $jobDescription,
                'role_skills' => null,
                'notes' => 'Employer consultation request'
            ];
            
            $leadId = $db->insertLead('employer', $leadData);
            
            if ($leadId) {
                // Send email notifications
                if (send_employer_form($name, $email, $mobile, $company, $jobDescription)) {
                    $message = "Thanks for your inquiry! We'll respond within 24 hours with a customized recruitment strategy.";
                    
                    // Clear form data on success
                    $_POST = [];
                } else {
                    $message = "Your inquiry was saved but there was an issue sending the confirmation email. We'll still get back to you soon.";
                }
            } else {
                $message = "There was an error saving your inquiry. Please try again.";
            }
            
        } catch (Exception $e) {
            error_log("Employer form error: " . $e->getMessage());
            $message = "There was an error processing your request. Please try again later.";
        }
    }
}
?>
