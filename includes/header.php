<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'HirMatic - AI-driven Recruitment'; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Global HR Tech & Recruitment platform based in India, serving worldwide with AI-driven automation and scalable solutions'; ?>">
    <meta name="keywords" content="<?php echo isset($page_keywords) ? $page_keywords : 'global recruitment from India, AI HR solutions, EOR for global hires, recruitment automation'; ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($page_title) ? $page_title : 'HirMatic - AI-driven Recruitment'; ?>">
    <meta property="og:description" content="<?php echo isset($page_description) ? $page_description : 'Global HR Tech & Recruitment platform based in India, serving worldwide with AI-driven automation and scalable solutions'; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:image" content="<?php echo 'https://' . $_SERVER['HTTP_HOST']; ?>/assets/images/hirmatic-og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>
</head>
<body>
    <!-- Header Navigation -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="index.php" class="logo">
                    HirMatic
                    <small style="color: #ccc; font-size: 0.6rem; font-weight: normal; margin-left: 10px;">Hire Global, Hire Automatic</small>
                </a>
                
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="employers.php">Employers</a></li>
                    <li><a href="candidates.php">Candidates</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="admin/" class="cta-button" style="padding: 8px 16px; font-size: 0.9rem;">Admin</a></li>
                </ul>
                
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    ☰
                </button>
            </nav>
        </div>
    </header>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobileMenu" class="mobile-menu" style="display: none;">
        <div class="mobile-menu-content">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="employers.php">Employers</a>
            <a href="candidates.php">Candidates</a>
            <a href="blog.php">Blog</a>
            <a href="contact.php">Contact</a>
            <a href="admin/">Admin</a>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobileMenu');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (!menu.contains(event.target) && !toggle.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    </script>
