<?php
$page_title = "For Employers - HirMatic AI Recruitment Solutions";
$page_description = "Transform your hiring process with HirMatic's AI-powered recruitment solutions. Global talent acquisition, strategic HR consulting, and EOR services for modern businesses.";
$page_keywords = "employers, recruitment services, AI hiring, talent acquisition, global hiring, EOR services, HR consulting";

require_once 'database/database.php';
require_once 'forms/employer_form.php';

include 'includes/header.php';
?>

<!-- Employers Hero -->
<section class="hero-gradient" style="min-height: 90vh; padding: 100px 0 50px;">
    <div class="container">
        <div class="hero-content" style="max-width: 1000px; margin: 0 auto; text-align: center;">
            <h1 class="hero-title">
                <span class="text-gradient">AI-Powered Recruitment</span><br>
                That Actually Works
            </h1>
            
            <div class="hero-tagline">
                🦈 Finding the Perfect Catch for Your Team
            </div>
            
            <p class="hero-description">
                Transform your hiring process with intelligent automation, global talent access, 
                and strategic HR solutions that reduce costs while improving hire quality.
            </p>
            
            <div style="display: flex; gap: 1rem; justify-content: center; margin: 2rem 0; flex-wrap: wrap;">
                <div style="background: rgba(255, 255, 255, 0.1); padding: 1rem; border-radius: 8px; border-left: 4px solid var(--primary-orange);">
                    <span style="color: var(--primary-orange); font-weight: 600;">⚡ 85% faster time-to-hire</span>
                </div>
                <div style="background: rgba(255, 255, 255, 0.1); padding: 1rem; border-radius: 8px; border-left: 4px solid var(--primary-green);">
                    <span style="color: var(--primary-green); font-weight: 600;">🎯 70% better candidate quality</span>
                </div>
            </div>
            
            <div class="hero-buttons">
                <a href="#request-consultation" class="cta-button-large">Request Free Consultation</a>
                <a href="#our-services" class="cta-button-secondary-large">Explore Services</a>
            </div>
        </div>
    </div>
</section>

<!-- Our Services -->
<section class="services-section" id="our-services">
    <div class="container">
        <h2 class="section-title">Our <span class="text-gradient">Services</span></h2>
        
        <div class="services-grid">
            <!-- Core Services -->
            <div class="service-card" style="border-left: 4px solid var(--primary-orange);">
                <div class="service-icon">🎯</div>
                <h3>Global Talent Acquisition</h3>
                <div style="background: rgba(255, 87, 34, 0.2); color: var(--primary-orange); padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-bottom: 1rem; display: inline-block;">Core Service</div>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Finding qualified candidates in today's competitive market is increasingly challenging and time-consuming.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> Our AI-powered platform sources, screens, and matches candidates globally, reducing your time-to-hire by 85% while improving candidate quality.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>AI-powered candidate sourcing and matching</li>
                    <li>Global executive search and headhunting</li>
                    <li>Specialized talent identification</li>
                    <li>Automated screening and assessment</li>
                    <li>Cultural fit analysis</li>
                </ul>
            </div>
            
            <div class="service-card" style="border-left: 4px solid var(--primary-green);">
                <div class="service-icon">⚡</div>
                <h3>Strategic HR & Growth</h3>
                <div style="background: rgba(76, 175, 80, 0.2); color: var(--primary-green); padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-bottom: 1rem; display: inline-block;">Core Service</div>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Scaling teams while maintaining culture and performance standards requires strategic HR expertise.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> We provide comprehensive HR strategy and execution support to help you build high-performing teams that drive business growth.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>HR strategy development and implementation</li>
                    <li>Performance management systems</li>
                    <li>Employee retention and engagement</li>
                    <li>Organizational design and restructuring</li>
                    <li>Leadership development programs</li>
                </ul>
            </div>
            
            <div class="service-card" style="border-left: 4px solid #2196F3;">
                <div class="service-icon">🌍</div>
                <h3>Global HR Operations</h3>
                <div style="background: rgba(33, 150, 243, 0.2); color: #2196F3; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-bottom: 1rem; display: inline-block;">Core Service</div>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Managing international employees involves complex legal, payroll, and compliance challenges.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> Our comprehensive EOR services handle all aspects of global employment, allowing you to hire anywhere while staying compliant.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>Employer of Record (EOR) services</li>
                    <li>Global payroll management</li>
                    <li>Visa and work permit assistance</li>
                    <li>International compliance management</li>
                    <li>Benefits administration worldwide</li>
                </ul>
            </div>
            
            <!-- Premium Consulting Services -->
            <div class="service-card" style="border-left: 4px solid #9C27B0;">
                <div class="service-icon">🧠</div>
                <h3>Executive Search & Leadership Consulting</h3>
                <div style="background: rgba(156, 39, 176, 0.2); color: #9C27B0; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-bottom: 1rem; display: inline-block;">Premium Consulting</div>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Finding and attracting C-level executives requires specialized expertise and extensive networks.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> Our executive search consultants leverage AI insights and personal networks to identify and attract top-tier leadership talent.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>C-suite and VP-level executive search</li>
                    <li>Board member identification</li>
                    <li>Leadership assessment and coaching</li>
                    <li>Succession planning</li>
                    <li>Compensation benchmarking</li>
                </ul>
                <p style="color: var(--primary-green); font-weight: 600; margin-top: 1rem;">Starting from $15,000 per search</p>
            </div>
            
            <div class="service-card" style="border-left: 4px solid #FF9800;">
                <div class="service-icon">🏗️</div>
                <h3>HR Transformation & Digital Strategy</h3>
                <div style="background: rgba(255, 152, 0, 0.2); color: #FF9800; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-bottom: 1rem; display: inline-block;">Premium Consulting</div>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Problem:</strong> Modernizing HR processes and implementing new technologies requires strategic planning and change management.</p>
                <p style="color: #4ecdc4; font-size: 0.9rem; margin-bottom: 1rem;"><strong>Solution:</strong> We guide your complete HR transformation journey, from strategy to implementation, ensuring smooth adoption and maximum ROI.</p>
                <ul class="service-list" style="text-align: left; margin: 1rem 0;">
                    <li>HR technology assessment and selection</li>
                    <li>Process automation and optimization</li>
                    <li>Change management and training</li>
                    <li>Digital workplace design</li>
                    <li>ROI measurement and optimization</li>
                </ul>
                <p style="color: var(--primary-green); font-weight: 600; margin-top: 1rem;">Starting from $25,000 per project</p>
            </div>
        </div>
    </div>
</section>

<!-- Request Consultation Form -->
<section class="services-section" id="request-consultation">
    <div class="container">
        <h2 class="section-title">Request Your <span class="text-gradient">Free Consultation</span></h2>
        
        <div style="max-width: 600px; margin: 0 auto;">
            <?php if (isset($message)): ?>
                <div style="<?php echo strpos($message, 'Thanks') === false ? 'background: rgba(244, 67, 54, 0.2); border: 1px solid #f44336; color: #f44336;' : 'background: rgba(76, 175, 80, 0.2); border: 1px solid #4CAF50; color: #4CAF50;'; ?> padding: 1rem; border-radius: 8px; margin-bottom: 2rem; text-align: center;">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 12px; padding: 2rem; border: 1px solid rgba(255, 255, 255, 0.2);">
                <h3 style="margin-bottom: 1.5rem; color: white;">Tell us about your hiring needs</h3>
                
                <form method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                    <input type="text" name="name" placeholder="Full Name *" required 
                           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="email" name="email" placeholder="Business Email *" required 
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="tel" name="mobile" placeholder="Phone Number *" required 
                           value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <input type="text" name="company" placeholder="Company Name *" required 
                           value="<?php echo htmlspecialchars($_POST['company'] ?? ''); ?>"
                           style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                    
                    <textarea name="job_description" placeholder="Describe your hiring needs, roles, and timeline *" required 
                              style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem; min-height: 100px; resize: vertical;"><?php echo htmlspecialchars($_POST['job_description'] ?? ''); ?></textarea>
                    
                    <button type="submit" name="submit_employer" class="cta-button" style="width: 100%;">
                        🦈 Request Free Consultation
                    </button>
                </form>
                
                <p style="text-align: center; color: #999; font-size: 0.9rem; margin-top: 1rem;">
                    We'll respond within 24 hours with a customized recruitment strategy
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose HirMatic -->
<section class="stats-section">
    <div class="container">
        <h2 class="section-title" style="color: white;">Why Choose HirMatic?</h2>
        
        <div class="stats-grid" style="color: white;">
            <div class="stat-item">
                <div class="stat-number">⚡</div>
                <div class="stat-text">85% Faster Hiring Process</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">🎯</div>
                <div class="stat-text">70% Better Candidate Quality</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">💰</div>
                <div class="stat-text">60% Cost Reduction</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">🌍</div>
                <div class="stat-text">40+ Countries Covered</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">🤖</div>
                <div class="stat-text">AI-Powered Matching</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">🏆</div>
                <div class="stat-text">95% Client Satisfaction</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Transform Your Hiring Process?</h2>
        <p>Join hundreds of companies worldwide who trust HirMatic for their talent acquisition needs</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
            <a href="#request-consultation" class="cta-button">Get Started Today</a>
            <a href="contact.php" class="cta-button-secondary">Schedule a Call</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
