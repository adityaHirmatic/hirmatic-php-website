<?php
$page_title = "For Candidates - HirMatic Career Services";
$page_description = "Advance your career with HirMatic's AI-powered career services. Free resume analysis, career coaching, and access to global job opportunities.";
$page_keywords = "career services, job search, resume analysis, career coaching, AI career tools, global opportunities";

require_once 'database/database.php';
require_once 'forms/candidate_form.php';

include 'includes/header.php';
?>

<!-- Candidates Hero -->
<section class="hero-gradient" style="min-height: 90vh; padding: 100px 0 50px;">
    <div class="container">
        <div class="hero-content" style="max-width: 1000px; margin: 0 auto; text-align: center;">
            <h1 class="hero-title">
                Accelerate Your Career with <span class="text-gradient">AI-Powered Tools</span>
            </h1>
            
            <div class="hero-tagline">
                🐺 Unleash Your Professional Potential
            </div>
            
            <p class="hero-description">
                Access cutting-edge career tools, get matched with global opportunities, 
                and receive personalized coaching to fast-track your professional growth.
            </p>
            
            <div style="display: flex; gap: 1rem; justify-content: center; margin: 2rem 0; flex-wrap: wrap;">
                <div style="background: rgba(255, 255, 255, 0.1); padding: 1rem; border-radius: 8px; border-left: 4px solid var(--primary-green);">
                    <span style="color: var(--primary-green); font-weight: 600;">🤖 AI-powered resume analysis</span>
                </div>
                <div style="background: rgba(255, 255, 255, 0.1); padding: 1rem; border-radius: 8px; border-left: 4px solid var(--primary-orange);">
                    <span style="color: var(--primary-orange); font-weight: 600;">🌍 Global opportunity access</span>
                </div>
            </div>
            
            <div class="hero-buttons">
                <a href="#join-network" class="cta-button-large">Join Our Network</a>
                <a href="resume.php" class="cta-button-secondary-large">Free Resume Analysis</a>
            </div>
        </div>
    </div>
</section>

<!-- Free Services -->
<section class="services-section" id="free-services">
    <div class="container">
        <h2 class="section-title">Free <span class="text-gradient">Career Tools</span></h2>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">🤖</div>
                <h3>AI Resume Analysis</h3>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Your resume might be perfect, but is it ATS-compatible and recruiter-friendly?</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> Get instant AI-powered feedback on your resume's effectiveness, formatting, and keyword optimization.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>ATS compatibility check</li>
                    <li>Keyword optimization suggestions</li>
                    <li>Format and structure analysis</li>
                    <li>Industry-specific recommendations</li>
                    <li>Skills gap identification</li>
                </ul>
                <div style="margin-top: 1rem;">
                    <a href="resume.php" class="cta-button" style="width: 100%; text-align: center; display: block;">
                        Analyze My Resume
                    </a>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">🎯</div>
                <h3>Smart Job Matching</h3>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Finding relevant job opportunities that match your skills and career goals is time-consuming.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> Our AI analyzes your profile and automatically matches you with suitable positions worldwide.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>Personalized job recommendations</li>
                    <li>Skills-based matching algorithm</li>
                    <li>Global opportunity discovery</li>
                    <li>Company culture fit analysis</li>
                    <li>Salary range insights</li>
                </ul>
                <div style="margin-top: 1rem;">
                    <a href="#join-network" class="cta-button" style="width: 100%; text-align: center; display: block;">
                        Get Job Matches
                    </a>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">📊</div>
                <h3>Career Path Analysis</h3>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Understanding your career progression options and required skills can be unclear.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> Receive detailed insights into potential career paths, skill requirements, and growth trajectories.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>Career progression mapping</li>
                    <li>Skill development roadmap</li>
                    <li>Market demand analysis</li>
                    <li>Salary progression insights</li>
                    <li>Industry trend analysis</li>
                </ul>
                <div style="margin-top: 1rem;">
                    <a href="#join-network" class="cta-button" style="width: 100%; text-align: center; display: block;">
                        Explore Paths
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Premium Services -->
<section class="stats-section">
    <div class="container">
        <h2 class="section-title" style="color: white;">Premium Career Services</h2>
        
        <div class="services-grid">
            <div class="service-card" style="border-left: 4px solid #9C27B0;">
                <div class="service-icon">🎯</div>
                <h3>Career Path AI - Strategic Consulting</h3>
                <div style="background: rgba(156, 39, 176, 0.2); color: #9C27B0; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-bottom: 1rem; display: inline-block;">Premium Service</div>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Making strategic career decisions without expert guidance can lead to suboptimal outcomes.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> Get personalized 1-on-1 career coaching with AI insights to accelerate your professional growth.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>Personalized career strategy development</li>
                    <li>AI-powered market analysis</li>
                    <li>Executive presence coaching</li>
                    <li>LinkedIn profile optimization</li>
                    <li>Networking strategy and introductions</li>
                    <li>Salary negotiation support</li>
                </ul>
                <p style="color: var(--primary-green); font-weight: 600; margin-top: 1rem;">Starting from $299/session</p>
                <div style="margin-top: 1rem;">
                    <a href="contact.php" style="color: var(--primary-orange); text-decoration: none; font-weight: 600;">Book Consultation →</a>
                </div>
            </div>
            
            <div class="service-card" style="border-left: 4px solid #FF9800;">
                <div class="service-icon">🚀</div>
                <h3>Executive Career Transition</h3>
                <div style="background: rgba(255, 152, 0, 0.2); color: #FF9800; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-bottom: 1rem; display: inline-block;">Premium Service</div>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Senior-level career transitions require specialized strategies and executive networks.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> Comprehensive executive career transition support with access to C-suite opportunities worldwide.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>Executive resume and LinkedIn optimization</li>
                    <li>C-suite opportunity identification</li>
                    <li>Board positioning strategies</li>
                    <li>Executive interview coaching</li>
                    <li>Compensation package negotiation</li>
                    <li>Transition planning and onboarding</li>
                </ul>
                <p style="color: var(--primary-green); font-weight: 600; margin-top: 1rem;">Starting from $2,500/package</p>
                <div style="margin-top: 1rem;">
                    <a href="contact.php" style="color: var(--primary-orange); text-decoration: none; font-weight: 600;">Learn More →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Join Network Form -->
<section class="services-section" id="join-network">
    <div class="container">
        <h2 class="section-title">Join Our Global <span class="text-gradient">Talent Network</span></h2>
        
        <div style="max-width: 600px; margin: 0 auto;">
            <?php if (isset($message)): ?>
                <div style="<?php echo strpos($message, 'Thanks') === false ? 'background: rgba(244, 67, 54, 0.2); border: 1px solid #f44336; color: #f44336;' : 'background: rgba(76, 175, 80, 0.2); border: 1px solid #4CAF50; color: #4CAF50;'; ?> padding: 1rem; border-radius: 8px; margin-bottom: 2rem; text-align: center;">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 12px; padding: 2rem; border: 1px solid rgba(255, 255, 255, 0.2);">
                <h3 style="margin-bottom: 1.5rem; color: white;">Get matched with your next opportunity</h3>
                
                <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1rem;">
                    <input type="text" name="name" placeholder="Full Name *" required 
                           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="email" name="email" placeholder="Email Address *" required 
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="tel" name="mobile" placeholder="Phone Number *" required 
                           value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="text" name="role_skills" placeholder="Your Role/Key Skills *" required 
                           value="<?php echo htmlspecialchars($_POST['role_skills'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <div>
                        <label for="resume" style="color: white; display: block; margin-bottom: 0.5rem;">Upload Your Resume (Optional)</label>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx"
                               style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem; width: 100%;">
                        <small style="color: #999; font-size: 0.8rem;">PDF, DOC, or DOCX format (Max 5MB)</small>
                    </div>
                    
                    <textarea name="notes" placeholder="Tell us about your career goals, preferred locations, or specific requirements" 
                              style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem; min-height: 100px; resize: vertical;"><?php echo htmlspecialchars($_POST['notes'] ?? ''); ?></textarea>
                    
                    <button type="submit" name="submit_candidate" class="cta-button" style="width: 100%;">
                        🐺 Join Talent Network
                    </button>
                </form>
                
                <p style="text-align: center; color: #999; font-size: 0.9rem; margin-top: 1rem;">
                    We'll match you with relevant opportunities and keep you updated on market trends
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Current Opportunities -->
<section class="services-section">
    <div class="container">
        <h2 class="section-title">Current Global Opportunities</h2>
        
        <div style="text-align: center; margin-bottom: 2rem;">
            <p style="color: #ccc; font-size: 1.1rem;">Explore live job opportunities from our partner companies worldwide</p>
        </div>
        
        <!-- ATS Integration -->
        <div style="background: rgba(255, 255, 255, 0.05); border-radius: 12px; padding: 2rem; border: 1px solid rgba(255, 255, 255, 0.1);">
            <div style="position: relative; width: 100%; height: 600px; overflow: hidden; border-radius: 8px;">
                <iframe 
                    src="https://pyjamahr.com/jobs/65a57d5c123e52154e14a7b5" 
                    style="width: 100%; height: 100%; border: none; background: white;"
                    title="Global Career Opportunities">
                </iframe>
            </div>
            <p style="text-align: center; color: #ccc; margin-top: 1rem; font-size: 0.9rem;">
                Can't see the opportunities? <a href="https://pyjamahr.com/jobs/65a57d5c123e52154e14a7b5" target="_blank" style="color: var(--primary-orange); text-decoration: none;">Click here to open in a new window</a>
            </p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Accelerate Your Career?</h2>
        <p>Join thousands of professionals who have advanced their careers with HirMatic's AI-powered tools</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
            <a href="#join-network" class="cta-button">Join Our Network</a>
            <a href="resume.php" class="cta-button-secondary">Analyze Your Resume</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
