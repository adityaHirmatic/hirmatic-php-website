<?php
require_once 'database/database.php';

$slug = $_GET['slug'] ?? '';
if (empty($slug)) {
    header('Location: blog.php');
    exit;
}

$db = Database::getInstance();
$post = $db->getBlogPost($slug);

if (!$post) {
    header('HTTP/1.0 404 Not Found');
    $page_title = "Post Not Found - HirMatic";
    include 'includes/header.php';
    echo '<div class="container" style="padding: 100px 20px; text-align: center;">
            <h1 style="color: white;">Post Not Found</h1>
            <p style="color: #ccc;">The blog post you are looking for does not exist.</p>
            <a href="blog.php" class="cta-button">Back to Blog</a>
          </div>';
    include 'includes/footer.php';
    exit;
}

$page_title = htmlspecialchars($post['title']) . " - HirMatic Blog";
$page_description = htmlspecialchars($post['meta_description'] ?: $post['excerpt']);
$page_keywords = implode(', ', json_decode($post['tags'] ?: '[]', true));

include 'includes/header.php';
?>

<!-- Blog Post Hero -->
<section class="hero-gradient" style="min-height: 60vh; padding: 100px 0 50px;">
    <div class="container">
        <div class="hero-content" style="max-width: 800px; margin: 0 auto; text-align: center;">
            <div style="margin-bottom: 1rem; color: #999; font-size: 0.9rem;">
                <span style="color: var(--primary-orange);">
                    <?php echo date('F j, Y', strtotime($post['published_at'])); ?>
                </span>
                <span style="color: #ccc;"> • </span>
                <span style="color: var(--primary-green);">
                    By <?php echo htmlspecialchars($post['author']); ?>
                </span>
            </div>
            
            <h1 class="hero-title" style="font-size: clamp(1.8rem, 4vw, 3rem); line-height: 1.3;">
                <?php echo htmlspecialchars($post['title']); ?>
            </h1>
            
            <p class="hero-description" style="font-size: 1.1rem; margin-top: 1.5rem;">
                <?php echo htmlspecialchars($post['excerpt']); ?>
            </p>
            
            <?php if ($post['tags']): ?>
                <div style="display: flex; gap: 0.5rem; justify-content: center; margin-top: 2rem; flex-wrap: wrap;">
                    <?php 
                    $tags = json_decode($post['tags'], true);
                    if ($tags):
                        foreach ($tags as $tag): ?>
                            <span style="background: rgba(255, 87, 34, 0.2); color: var(--primary-orange); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem;"><?php echo htmlspecialchars($tag); ?></span>
                        <?php endforeach;
                    endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Featured Image -->
<?php if ($post['featured_image']): ?>
<section style="padding: 0; background: #111;">
    <div class="container">
        <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
             alt="<?php echo htmlspecialchars($post['title']); ?>" 
             style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 12px;">
    </div>
</section>
<?php endif; ?>

<!-- Blog Content -->
<section class="services-section">
    <div class="container">
        <article style="max-width: 800px; margin: 0 auto;">
            <div style="color: #ccc; line-height: 1.8; font-size: 1.1rem;">
                <?php echo $post['content']; ?>
            </div>
            
            <!-- Share Section -->
            <div style="margin: 3rem 0; padding: 2rem 0; border-top: 1px solid #333; border-bottom: 1px solid #333;">
                <h3 style="color: white; margin-bottom: 1rem;">Share this article</h3>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($post['title']); ?>" 
                       target="_blank" class="cta-button-secondary" style="padding: 8px 16px; font-size: 0.9rem;">
                        Share on Twitter
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
                       target="_blank" class="cta-button-secondary" style="padding: 8px 16px; font-size: 0.9rem;">
                        Share on LinkedIn
                    </a>
                    <button onclick="copyToClipboard()" class="cta-button-secondary" style="padding: 8px 16px; font-size: 0.9rem;">
                        Copy Link
                    </button>
                </div>
            </div>
            
            <!-- Navigation -->
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <a href="blog.php" class="cta-button-secondary">← Back to Blog</a>
                <a href="contact.php" class="cta-button">Get in Touch</a>
            </div>
        </article>
    </div>
</section>

<!-- Related CTA -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Transform Your Career or Hiring Process?</h2>
        <p>Get personalized insights and expert guidance from HirMatic's recruitment specialists</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
            <a href="employers.php" class="cta-button">For Employers</a>
            <a href="candidates.php" class="cta-button-secondary">For Job Seekers</a>
        </div>
    </div>
</section>

<script>
function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Link copied to clipboard!');
    });
}

// Add styling for blog content
document.addEventListener('DOMContentLoaded', function() {
    const content = document.querySelector('article > div');
    if (content) {
        // Style headings
        content.querySelectorAll('h2').forEach(h2 => {
            h2.style.color = 'var(--primary-orange)';
            h2.style.marginTop = '2rem';
            h2.style.marginBottom = '1rem';
        });
        
        content.querySelectorAll('h3').forEach(h3 => {
            h3.style.color = 'var(--primary-green)';
            h3.style.marginTop = '1.5rem';
            h3.style.marginBottom = '0.8rem';
        });
        
        // Style paragraphs
        content.querySelectorAll('p').forEach(p => {
            p.style.marginBottom = '1.2rem';
        });
        
        // Style lists
        content.querySelectorAll('ul, ol').forEach(list => {
            list.style.marginLeft = '1.5rem';
            list.style.marginBottom = '1.2rem';
        });
        
        content.querySelectorAll('li').forEach(li => {
            li.style.marginBottom = '0.5rem';
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
