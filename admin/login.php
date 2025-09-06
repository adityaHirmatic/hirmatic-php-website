<?php
session_start();
require_once '../database/database.php';

$error = '';

if ($_POST['login'] ?? false) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if ($username && $password) {
        $db = Database::getInstance();
        $user = $db->authenticateAdmin($username, $password);
        
        if ($user) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HirMatic</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-login-body {
            background: linear-gradient(135deg, #FF5722, #4CAF50);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 0 1rem;
        }
        
        .login-card {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header h1 {
            color: white;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }
        
        .login-header p {
            color: #ccc;
        }
        
        .login-form {
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: white;
            font-weight: 600;
        }
        
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            color: white;
            font-size: 1rem;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #FF5722;
            box-shadow: 0 0 10px rgba(255, 87, 34, 0.3);
        }
        
        .login-btn {
            width: 100%;
            background: linear-gradient(135deg, #FF5722, #e64a19);
            color: white;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 87, 34, 0.3);
        }
        
        .login-footer {
            text-align: center;
        }
        
        .back-to-site {
            color: #4CAF50;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .back-to-site:hover {
            color: #66BB6A;
        }
        
        .error-message {
            background: rgba(244, 67, 54, 0.2);
            border: 1px solid #f44336;
            color: #f44336;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body class="admin-login-body">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>HirMatic Admin</h1>
                <p>Sign in to manage your website</p>
            </div>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required 
                           value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" name="login" class="login-btn">
                    Sign In
                </button>
            </form>
            
            <div class="login-footer">
                <p><small>Default login: admin / admin123!</small></p>
                <a href="../" class="back-to-site">← Back to Website</a>
            </div>
        </div>
    </div>
</body>
</html>
