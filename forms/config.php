<?php
// Email Configuration for HirMatic
// Update these settings with your actual credentials

// SMTP Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your_email@gmail.com');
define('SMTP_PASSWORD', 'your_gmail_app_password_here'); // Replace with your Gmail App Password
define('SMTP_SECURE', 'tls');

// Email Settings
define('ADMIN_EMAIL', 'your_email@gmail.com');
define('FROM_EMAIL', 'no-reply@hirmatic.com');
define('FROM_NAME', 'HirMatic');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_database_username');
define('DB_PASS', 'your_database_password');

// File Upload Configuration
define('UPLOAD_DIR', 'uploads/resumes/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['pdf', 'doc', 'docx']);

// Site Configuration
define('SITE_URL', 'https://your-domain.com');
define('SITE_NAME', 'HirMatic');

// Error Reporting (Set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
