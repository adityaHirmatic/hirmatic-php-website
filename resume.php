<?php
$page_title = "Free AI Resume Analysis - HirMatic";
$page_description = "Get instant AI-powered feedback on your resume. Improve your chances of landing your dream job with our free resume analysis tool.";
$page_keywords = "resume analysis, AI resume review, career tools, job search, resume feedback";

require_once 'database/database.php';
require_once 'ai/resume_analyzer.php';
require_once 'forms/send.php';

$message = '';
$analysis = null;

if (isset($_POST['analyze_resume'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    
    if (empty($name) || empty($email)) {
        $message = "Please provide your name and email address.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } elseif (!isset($_FILES['resume']) || $_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
        $message = "Please upload your resume file.";
    } else {
        // Handle file upload
        $uploadDir = 'uploads/resumes/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $file = $_FILES['resume'];
        $filename = date('Y-m-d_H-i-s') . '_' . uniqid() . '_' . $file['name'];
        $filepath = $uploadDir . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            try {
                // Initialize AI analyzer
                $analyzer = new ResumeAnalyzer();
                
                // Extract text from file
                $resumeText = $analyzer->extractTextFromFile($filepath);
                
                // Analyze resume
                $analysis = $analyzer->analyzeResume($resumeText);
                
                // Save to database
                $db = Database::getInstance();
                $leadId = $db->insertLead('candidate', [
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'role_skills' => 'Resume Analysis Request',
                    'notes' => 'AI Resume Analysis'
                ]);
                
                if ($leadId) {
                    $db->insertResumeUpload(
                        $leadId,
                        $file['name'],
                        $filepath,
                        $file['size'],
                        $file['type'],
                        $analysis,
                        $analysis['overall_score'] ?? null
                    );
                }
                
                $message = "Analysis complete! Check your results below and we'll also send a detailed report to your email.";
                
            } catch (Exception $e) {
                error_log("Resume analysis error: " . $e->getMessage());
                $message = "There was an error analyzing your resume. Our team will review it manually and get back to you within 24 hours.";
            }
        } else {
            $message = "Failed to upload your resume. Please try again.";
        }
    }
}

include 'includes/header.php';
?>

<!-- Resume Analysis Hero -->
<section class="hero-gradient" style="min-height: 90vh; padding: 100px 0 50px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; max-width: 1200px; margin: 0 auto;">
            <div>
                <h1 class="hero-title">
                    Free AI <span class="text-gradient">Resume Analysis</span>
                </h1>
                
                <p class="hero-description">
                    Get instant, AI-powered feedback on your resume. Discover what recruiters see, 
                    identify improvement areas, and boost your chances of landing interviews.
                </p>
                
                <div style="display: flex; flex-direction: column; gap: 1rem; margin: 2rem 0;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--primary-green); font-weight: 600;">✓</span>
                        <span>Instant AI-powered analysis</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--primary-green); font-weight: 600;">✓</span>
                        <span>ATS compatibility check</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--primary-green); font-weight: 600;">✓</span>
                        <span>Personalized recommendations</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--primary-green); font-weight: 600;">✓</span>
                        <span>Skills gap analysis</span>
                    </div>
                </div>
                
                <div style="display: flex; gap: 2rem; margin: 2rem 0;">
                    <div style="text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: var(--primary-orange);">50K+</div>
                        <div style="color: #ccc; font-size: 0.9rem;">Resumes Analyzed</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 2rem; font-weight: bold; color: var(--primary-green);">92%</div>
                        <div style="color: #ccc; font-size: 0.9rem;">Success Rate</div>
                    </div>
                </div>
            </div>
            
            <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 12px; padding: 2rem; border: 1px solid rgba(255, 255, 255, 0.2);">
                <h2 style="color: white; margin-bottom: 1.5rem; text-align: center;">Upload Your Resume</h2>
                
                <?php if ($message): ?>
                    <div style="<?php echo $analysis ? 'background: rgba(76, 175, 80, 0.2); border: 1px solid #4CAF50; color: #4CAF50;' : 'background: rgba(244, 67, 54, 0.2); border: 1px solid #f44336; color: #f44336;'; ?> padding: 1rem; border-radius: 8px; margin-bottom: 1rem; text-align: center;">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1rem;">
                    <input type="text" name="name" placeholder="Full Name *" required 
                           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="email" name="email" placeholder="Email Address *" required 
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="tel" name="mobile" placeholder="Mobile Number" 
                           value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <div>
                        <label for="resume" style="color: white; display: block; margin-bottom: 0.5rem;">Upload Resume (PDF, DOC, DOCX) *</label>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required
                               style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem; width: 100%;">
                        <small style="color: #999; font-size: 0.8rem;">Max file size: 5MB</small>
                    </div>
                    
                    <button type="submit" name="analyze_resume" class="cta-button" style="width: 100%;">
                        🤖 Analyze My Resume
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php if ($analysis): ?>
<!-- Analysis Results -->
<section class="services-section">
    <div class="container">
        <h2 class="section-title">Your Resume <span class="text-gradient">Analysis Results</span></h2>
        
        <!-- Overall Score -->
        <div style="text-align: center; margin-bottom: 3rem;">
            <div style="display: inline-block; padding: 2rem; background: rgba(255, 255, 255, 0.1); border-radius: 20px; border: 3px solid <?php echo ($analysis['overall_score'] ?? 0) >= 80 ? '#4CAF50' : (($analysis['overall_score'] ?? 0) >= 60 ? '#FF9800' : '#f44336'); ?>;">
                <div style="font-size: 4rem; font-weight: bold; color: <?php echo ($analysis['overall_score'] ?? 0) >= 80 ? '#4CAF50' : (($analysis['overall_score'] ?? 0) >= 60 ? '#FF9800' : '#f44336'); ?>;">
                    <?php echo $analysis['overall_score'] ?? 'N/A'; ?><?php echo is_numeric($analysis['overall_score'] ?? '') ? '/100' : ''; ?>
                </div>
                <div style="color: white; font-size: 1.2rem; margin-top: 0.5rem;">Overall Score</div>
            </div>
        </div>
        
        <div class="services-grid">
            <!-- Strengths -->
            <div class="service-card">
                <div class="service-icon">💪</div>
                <h3>Strengths</h3>
                <ul style="text-align: left; margin: 1rem 0; list-style: none; padding: 0;">
                    <?php foreach (($analysis['strengths'] ?? []) as $strength): ?>
                        <li style="color: #4CAF50; margin-bottom: 0.5rem;">✓ <?php echo htmlspecialchars($strength); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Areas for Improvement -->
            <div class="service-card">
                <div class="service-icon">🎯</div>
                <h3>Areas for Improvement</h3>
                <ul style="text-align: left; margin: 1rem 0; list-style: none; padding: 0;">
                    <?php foreach (($analysis['weaknesses'] ?? []) as $weakness): ?>
                        <li style="color: #FF9800; margin-bottom: 0.5rem;">⚠ <?php echo htmlspecialchars($weakness); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Recommendations -->
            <div class="service-card">
                <div class="service-icon">💡</div>
                <h3>Recommendations</h3>
                <ul style="text-align: left; margin: 1rem 0; list-style: none; padding: 0;">
                    <?php foreach (($analysis['recommendations'] ?? []) as $recommendation): ?>
                        <li style="color: #2196F3; margin-bottom: 0.5rem;">→ <?php echo htmlspecialchars($recommendation); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Summary -->
            <div class="service-card" style="grid-column: 1 / -1;">
                <div class="service-icon">📋</div>
                <h3>AI Analysis Summary</h3>
                <p style="color: #ccc; font-size: 1.1rem; line-height: 1.6;">
                    <?php echo htmlspecialchars($analysis['summary'] ?? 'Analysis completed successfully.'); ?>
                </p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- How It Works -->
<section class="stats-section">
    <div class="container">
        <h2 class="section-title" style="color: white;">How Our AI Analysis Works</h2>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">📤</div>
                <h3>1. Upload</h3>
                <p>Upload your resume in PDF, DOC, or DOCX format. Our system securely processes your document.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">🤖</div>
                <h3>2. AI Analysis</h3>
                <p>Our advanced AI analyzes content, structure, keywords, and ATS compatibility using the latest Gemini technology.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">📊</div>
                <h3>3. Get Results</h3>
                <p>Receive instant feedback with actionable recommendations to improve your resume's effectiveness.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Take Your Career to the Next Level?</h2>
        <p>Join thousands of professionals who have improved their resumes with our AI-powered analysis</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
            <a href="candidates.php" class="cta-button">Explore Career Services</a>
            <a href="contact.php" class="cta-button-secondary">Get Personal Consultation</a>
        </div>
    </div>
</section>

<style>
@media (max-width: 768px) {
    .hero-gradient > .container > div {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
