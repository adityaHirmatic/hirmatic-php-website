-- HirMatic Database Schema
-- MySQL Database Structure for Hostinger hosting

CREATE DATABASE IF NOT EXISTS hirmatic_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hirmatic_db;

-- Leads table
CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('employer', 'candidate', 'contact') NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mobile VARCHAR(20),
    company VARCHAR(255),
    job_description TEXT,
    role_skills TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'contacted', 'in_progress', 'closed') DEFAULT 'new',
    INDEX idx_type (type),
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
);

-- Resume uploads table
CREATE TABLE IF NOT EXISTS resume_uploads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lead_id INT,
    original_filename VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_size INT,
    mime_type VARCHAR(100),
    ai_analysis JSON,
    analysis_score INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lead_id) REFERENCES leads(id) ON DELETE CASCADE,
    INDEX idx_lead_id (lead_id)
);

-- Blog posts table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(500) NOT NULL,
    slug VARCHAR(500) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(500),
    meta_description TEXT,
    tags JSON,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    author VARCHAR(255) DEFAULT 'HirMatic Team',
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_status (status),
    INDEX idx_published_at (published_at)
);

-- Admin users table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_username (username)
);

-- Contact submissions table
CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mobile VARCHAR(20),
    subject VARCHAR(500),
    message TEXT NOT NULL,
    status ENUM('new', 'responded', 'archived') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_status (status)
);

-- Insert default admin user (password: admin123!)
INSERT INTO admin_users (username, password_hash, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@hirmatic.com');

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, excerpt, content, featured_image, tags, status, published_at) VALUES
('Top 5 Remote Work Skills Employers Are Looking For in 2025', 
 'remote-work-skills-2025', 
 'Discover the essential skills that make remote workers stand out in today''s competitive job market.',
 '<h2>The Future of Remote Work</h2><p>As we move deeper into 2025, the landscape of remote work continues to evolve. Companies are no longer just looking for technical skills—they want professionals who can thrive in a distributed work environment.</p><h3>1. Advanced Digital Communication</h3><p>Beyond basic video calls, employers want candidates who can effectively communicate through various digital channels, manage asynchronous conversations, and build relationships virtually.</p><h3>2. Self-Management and Accountability</h3><p>The ability to set priorities, manage time effectively, and deliver results without constant supervision has become crucial.</p>',
 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=800&h=400&fit=crop',
 '["remote work", "skills", "employment", "2025"]',
 'published',
 NOW()),

('How AI is Revolutionizing the Recruitment Process', 
 'ai-recruitment-revolution', 
 'Explore how artificial intelligence is transforming talent acquisition and what it means for both employers and job seekers.',
 '<h2>The AI Revolution in Hiring</h2><p>Artificial Intelligence is reshaping recruitment from initial candidate screening to final selection decisions. This transformation is creating more efficient processes while raising important questions about fairness and bias.</p><h3>AI-Powered Resume Screening</h3><p>Modern ATS systems can analyze thousands of resumes in minutes, identifying key qualifications and matching candidates to job requirements with unprecedented accuracy.</p>',
 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800&h=400&fit=crop',
 '["AI", "recruitment", "hiring", "technology"]',
 'published',
 DATE_SUB(NOW(), INTERVAL 5 DAY));
