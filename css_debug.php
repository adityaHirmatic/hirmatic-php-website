<!DOCTYPE html>
<html>
<head>
    <title>CSS Debug Test</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 20px; }
        .test-box { background: red; color: white; padding: 20px; margin: 20px 0; }
        .success { background: green; }
    </style>
</head>
<body>
    <h1>CSS Loading Test</h1>
    
    <div class="test-box">If you see RED background, inline CSS works</div>
    
    <?php
    echo "<h2>File System Check:</h2>";
    echo "<p>Current directory: " . getcwd() . "</p>";
    echo "<p>CSS file exists at './assets/css/style.css': " . (file_exists('./assets/css/style.css') ? 'YES' : 'NO') . "</p>";
    echo "<p>CSS file exists at 'assets/css/style.css': " . (file_exists('assets/css/style.css') ? 'YES' : 'NO') . "</p>";
    
    if (file_exists('./assets/css/style.css')) {
        echo "<div class='success'>✅ CSS file found! Size: " . filesize('./assets/css/style.css') . " bytes</div>";
        echo "<h3>CSS Content Preview:</h3>";
        echo "<textarea style='width:100%; height:150px;'>" . substr(file_get_contents('./assets/css/style.css'), 0, 500) . "</textarea>";
    } else {
        echo "<div class='test-box'>❌ CSS file NOT found!</div>";
    }
    ?>
    
    <h2>External CSS Test:</h2>
    <link rel="stylesheet" href="./assets/css/style.css">
    <div class="hero-gradient" style="min-height: 100px; padding: 20px;">
        <p style="color: white;">If this has orange/green gradient background, external CSS works!</p>
    </div>
</body>
</html>
