<?php
session_start();
require_once '../database/database.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();
$analytics = $db->getLeadsAnalytics();
$recentPosts = $db->getBlogPosts('published', 5, 0);

$page_title = "Admin Dashboard - HirMatic";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-body {
            background: #1a1a1a;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            padding-top: 80px;
        }
        
        .admin-header {
            background: #000;
            padding: 1rem 2rem;
            border-bottom: 1px solid #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }
        
        .admin-container {
            padding: 2rem;
        }
        
        .admin-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .admin-stat-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .stat-icon {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #FF5722, #4CAF50);
            border-radius: 12px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .stat-info {
            flex: 1;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: white;
        }
        
        .stat-label {
            color: #ccc;
            font-size: 0.9rem;
        }
        
        .admin-section {
            margin-bottom: 3rem;
        }
        
        .admin-section h2 {
            color: white;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .admin-table-wrapper {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .admin-table th {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            text-align: left;
            color: white;
            font-weight: 600;
        }
        
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
        }
        
        .admin-table tr:last-child td {
            border-bottom: none;
        }
        
        .admin-btn {
            background: linear-gradient(135deg, #FF5722, #e64a19);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .admin-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
        }
        
        .admin-btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="admin-body">
    <header class="admin-header">
        <div>
            <h1 style="color: white; margin: 0;">HirMatic Admin Dashboard</h1>
        </div>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></span>
            <a href="logout.php" class="admin-btn admin-btn-sm">Logout</a>
        </div>
    </header>

    <div class="admin-container">
        <h1>Dashboard</h1>
        
        <!-- Analytics Cards -->
        <div class="admin-stats-grid">
            <div class="admin-stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $analytics['total_leads'] ?? 0; ?></div>
                    <div class="stat-label">Total Leads</div>
                </div>
            </div>
            
            <div class="admin-stat-card">
                <div class="stat-icon">🏢</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $analytics['employer_leads'] ?? 0; ?></div>
                    <div class="stat-label">Employer Leads</div>
                </div>
            </div>
            
            <div class="admin-stat-card">
                <div class="stat-icon">👨‍💼</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $analytics['candidate_leads'] ?? 0; ?></div>
                    <div class="stat-label">Candidate Leads</div>
                </div>
            </div>
            
            <div class="admin-stat-card">
                <div class="stat-icon">📄</div>
                <div class="stat-info">
                    <div class="stat-number"><?php echo $analytics['resume_uploads'] ?? 0; ?></div>
                    <div class="stat-label">Resume Uploads</div>
                </div>
            </div>
        </div>
        
        <!-- Recent Blog Posts -->
        <div class="admin-section">
            <h2>Recent Blog Posts</h2>
            <?php if (!empty($recentPosts)): ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Published</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentPosts as $post): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo htmlspecialchars($post['title']); ?></strong>
                                    </td>
                                    <td>
                                        <span style="background: rgba(76, 175, 80, 0.2); color: #4CAF50; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                            <?php echo ucfirst($post['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $post['published_at'] ? date('M j, Y', strtotime($post['published_at'])) : 'Not published'; ?></td>
                                    <td>
                                        <a href="../blog-post.php?slug=<?php echo urlencode($post['slug']); ?>" target="_blank" class="admin-btn admin-btn-sm">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p style="color: #666;">No blog posts found.</p>
            <?php endif; ?>
        </div>
        
        <!-- Quick Actions -->
        <div class="admin-section">
            <h2>Quick Actions</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <a href="../blog.php" target="_blank" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 1rem; color: white; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease;">
                    <span style="font-size: 1.5rem;">📝</span>
                    View Blog
                </a>
                <a href="../contact.php" target="_blank" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 1rem; color: white; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease;">
                    <span style="font-size: 1.5rem;">📊</span>
                    View Contact
                </a>
                <a href="../" target="_blank" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 1rem; color: white; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease;">
                    <span style="font-size: 1.5rem;">🌐</span>
                    View Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>
