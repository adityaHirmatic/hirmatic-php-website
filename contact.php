<?php
$page_title = "Contact HirMatic - Get in Touch";
$page_description = "Contact HirMatic for AI-driven recruitment solutions. Get in touch with our team for inquiries about talent acquisition, career services, or partnerships.";
$page_keywords = "contact HirMatic, recruitment inquiry, talent acquisition contact, HR solutions contact";

require_once 'database/database.php';
require_once 'forms/send.php';

$message = '';

if (isset($_POST['submit_contact'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $messageText = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($messageText)) {
        $message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } else {
        try {
            // Save to database
            $db = Database::getInstance();
            $contactData = [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'subject' => $subject,
                'message' => $messageText
            ];
            
            if ($db->insertContactSubmission($contactData)) {
                // Send email notification
                if (send_contact_form($name, $email, $mobile, $messageText)) {
                    $message = "Thank you for contacting us! We'll get back to you within 24 hours.";
                    $_POST = [];
                } else {
                    $message = "Your message was saved but there was an issue sending the notification. We'll still respond to you soon.";
                }
            } else {
                $message = "There was an error saving your message. Please try again.";
            }
        } catch (Exception $e) {
            error_log("Contact form error: " . $e->getMessage());
            $message = "There was an error processing your request. Please try again later.";
        }
    }
}

include 'includes/header.php';
?>

<!-- Contact Hero -->
<section class="hero-gradient" style="min-height: 80vh; padding: 100px 0 50px;">
    <div class="container">
        <div class="hero-content" style="max-width: 800px; margin: 0 auto;">
            <h1 class="hero-title">Get in <span class="text-gradient">Touch</span></h1>
            
            <p class="hero-description">
                Ready to transform your hiring process or advance your career? 
                Our team is here to help you achieve your goals with AI-powered recruitment solutions.
            </p>
            
            <?php if ($message): ?>
                <div style="<?php echo strpos($message, 'Thank you') === false ? 'background: rgba(244, 67, 54, 0.2); border: 1px solid #f44336; color: #f44336;' : 'background: rgba(76, 175, 80, 0.2); border: 1px solid #4CAF50; color: #4CAF50;'; ?> padding: 1rem; border-radius: 8px; margin: 2rem 0; text-align: center;">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 12px; padding: 2rem; border: 1px solid rgba(255, 255, 255, 0.2); margin-top: 2rem;">
                <h2 style="margin-bottom: 1.5rem; color: white; font-size: 1.5rem;">Send us a message</h2>
                
                <form method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                    <input type="text" name="name" placeholder="Full Name *" required 
                           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="email" name="email" placeholder="Email Address *" required 
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="tel" name="mobile" placeholder="Mobile Number" 
                           value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="text" name="subject" placeholder="Subject" 
                           value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <textarea name="message" placeholder="Your Message *" required 
                              style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem; min-height: 100px; resize: vertical;"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                    
                    <button type="submit" name="submit_contact" class="cta-button" style="width: 100%;">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="services-section">
    <div class="container">
        <h2 class="section-title">Multiple Ways to <span class="text-gradient">Connect</span></h2>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">✉️</div>
                <h3>Email Support</h3>
                <p>Get detailed responses to your inquiries and questions.</p>
                <div style="margin-top: 1rem;">
                    <p style="color: var(--primary-orange);"><strong>General Inquiries:</strong><br>
                    <a href="mailto:hello@hirmatic.com" style="color: var(--primary-orange); text-decoration: none;">hello@hirmatic.com</a></p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">📞</div>
                <h3>Phone Consultation</h3>
                <p>Schedule a call with our recruitment specialists for personalized guidance.</p>
                <div style="margin-top: 1rem;">
                    <p style="color: var(--primary-orange);"><strong>Business Hours:</strong><br>
                    Monday - Friday: 9 AM - 6 PM IST</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">🏢</div>
                <h3>Headquarters - India</h3>
                <p>Our main operations center with AI development and global coordination teams.</p>
                <div style="margin-top: 1rem; color: #ccc;">
                    <p><strong>Location:</strong> Mumbai, India</p>
                    <p><strong>Time Zone:</strong> IST (UTC+5:30)</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Let's discuss how HirMatic can transform your hiring process or accelerate your career growth</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
            <a href="employers.php" class="cta-button">For Employers</a>
            <a href="candidates.php" class="cta-button-secondary">For Job Seekers</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
