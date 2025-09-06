<?php
require_once __DIR__ . '/../forms/config.php';

class Database {
    private $connection;
    private static $instance = null;
    
    private function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    // Lead management methods
    public function insertLead($type, $data) {
        $sql = "INSERT INTO leads (type, name, email, mobile, company, job_description, role_skills, notes) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([
            $type,
            $data['name'],
            $data['email'],
            $data['mobile'] ?? null,
            $data['company'] ?? null,
            $data['job_description'] ?? null,
            $data['role_skills'] ?? null,
            $data['notes'] ?? null
        ]);
        
        return $result ? $this->connection->lastInsertId() : false;
    }
    
    public function insertResumeUpload($leadId, $filename, $filepath, $filesize, $mimetype, $analysis = null, $score = null) {
        $sql = "INSERT INTO resume_uploads (lead_id, original_filename, file_path, file_size, mime_type, ai_analysis, analysis_score) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            $leadId,
            $filename,
            $filepath,
            $filesize,
            $mimetype,
            $analysis ? json_encode($analysis) : null,
            $score
        ]);
    }
    
    // Blog management methods
    public function getBlogPosts($status = 'published', $limit = 10, $offset = 0) {
        $sql = "SELECT * FROM blog_posts WHERE status = ? ORDER BY published_at DESC LIMIT ? OFFSET ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$status, $limit, $offset]);
        return $stmt->fetchAll();
    }
    
    public function getBlogPost($slug) {
        $sql = "SELECT * FROM blog_posts WHERE slug = ? AND status = 'published'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
    
    // Analytics methods
    public function getLeadsAnalytics() {
        $sql = "SELECT 
                    COUNT(*) as total_leads,
                    SUM(CASE WHEN type = 'employer' THEN 1 ELSE 0 END) as employer_leads,
                    SUM(CASE WHEN type = 'candidate' THEN 1 ELSE 0 END) as candidate_leads,
                    SUM(CASE WHEN type = 'contact' THEN 1 ELSE 0 END) as contact_leads,
                    (SELECT COUNT(*) FROM resume_uploads) as resume_uploads
                FROM leads";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    // Contact form methods
    public function insertContactSubmission($data) {
        $sql = "INSERT INTO contact_submissions (name, email, mobile, subject, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['mobile'] ?? null,
            $data['subject'] ?? null,
            $data['message']
        ]);
    }
    
    // Admin authentication
    public function authenticateAdmin($username, $password) {
        $sql = "SELECT id, username, password_hash FROM admin_users WHERE username = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            // Update last login
            $updateSql = "UPDATE admin_users SET last_login = NOW() WHERE id = ?";
            $updateStmt = $this->connection->prepare($updateSql);
            $updateStmt->execute([$user['id']]);
            
            return $user;
        }
        
        return false;
    }
}
?>
