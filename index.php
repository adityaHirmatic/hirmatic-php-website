<?php
$page_title = "HirMatic - AI-driven Recruitment";
$page_description = "Global HR Tech & Recruitment platform based in India, serving worldwide with AI-driven automation and scalable solutions";
$page_keywords = "global recruitment from India, AI HR solutions, EOR for global hires, recruitment automation";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-gradient">
    <div class="hero-content">
        <h1 class="hero-title">
            AI-driven Recruitment that 
            <span class="text-gradient">Feels Effortless</span>
        </h1>
        
        <div class="hero-tagline">
            🦈 Shark seeks Wolf • Wolf seeks Shark 🐺
        </div>
        
        <p class="hero-description">
            Automation-first workflows and global talent matching powered by cutting-edge AI
        </p>
        
        <div class="hero-buttons">
            <a href="employers.php" class="cta-button-large">
                🦈 Request Consultation
            </a>
            <a href="candidates.php" class="cta-button-secondary-large">
                🐺 Explore Career Services
            </a>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="services-section">
    <div class="container">
        <h2 class="section-title">
            Our <span class="text-gradient">Services</span>
        </h2>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">🎯</div>
                <h3>Global Talent Acquisition</h3>
                <p>AI-powered sourcing and global executive search with specialized talent identification</p>
                <a href="employers.php" class="service-link">Learn More →</a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">⚡</div>
                <h3>Strategic HR & Growth</h3>
                <p>HR strategy development, performance management, and employee retention solutions</p>
                <a href="employers.php" class="service-link">Learn More →</a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">🌍</div>
                <h3>Global HR Operations</h3>
                <p>EOR services for global employees, payroll management, and compliance solutions</p>
                <a href="employers.php" class="service-link">Learn More →</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
File 2: includes/header.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'HirMatic - AI-driven Recruitment'; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Global HR Tech & Recruitment platform'; ?>">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="index.php" class="logo">HirMatic</a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="employers.php">Employers</a></li>
                    <li><a href="candidates.php">Candidates</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
