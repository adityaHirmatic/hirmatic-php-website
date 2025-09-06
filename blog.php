<?php
$page_title = "Blog - HirMatic Insights";
$page_description = "Stay updated with the latest trends in recruitment, AI in hiring, career tips, and HR technology insights from HirMatic experts.";
$page_keywords = "recruitment blog, AI hiring, career tips, HR technology, job search, talent acquisition";

require_once 'database/database.php';
include 'includes/header.php';

$db = Database::getInstance();
$blogPosts = $db->getBlogPosts('published', 20, 0);
?>

<!-- Blog Hero Section -->
<section class="hero-gradient" style="min-height: 70vh; padding: 100px 0 50px;">
    <div class="container">
        <div class="hero-content" style="text-align: center;">
            <h1 class="hero-title">
                HirMatic <span class="text-gradient">Insights</span>
            </h1>
            
            <p class="hero-description">
                Stay ahead of the curve with expert insights on recruitment, AI in hiring, 
                career development, and the future of work.
            </p>
            
            <div class="hero-buttons">
                <a href="#latest-posts" class="cta-button">Read Latest Posts</a>
                <a href="candidates.php" class="cta-button-secondary">Career Resources</a>
            </div>
        </div>
    </div>
</section>

<!-- Blog Posts Grid -->
<section class="services-section" id="latest-posts">
    <div class="container">
        <h2 class="section-title">Latest <span class="text-gradient">Articles</span></h2>
        
        <?php if (!empty($blogPosts)): ?>
            <div class="services-grid">
                <?php foreach ($blogPosts as $post): ?>
                    <article class="service-card">
                        <?php if ($post['featured_image']): ?>
                            <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($post['title']); ?>" 
                                 style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                        <?php endif; ?>
                        
                        <div style="margin-bottom: 1rem; color: #999; font-size: 0.9rem;">
                            <span><?php echo date('M j, Y', strtotime($post['published_at'])); ?></span>
                            <span> • By <?php echo htmlspecialchars($post['author']); ?></span>
                        </div>
                        
                        <h3 style="color: white; margin-bottom: 1rem; font-size: 1.2rem;">
                            <a href="blog-post.php?slug=<?php echo urlencode($post['slug']); ?>" 
                               style="color: white; text-decoration: none;">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a>
                        </h3>
                        
                        <p style="color: #ccc; margin-bottom: 1rem; line-height: 1.6;">
                            <?php echo htmlspecialchars($post['excerpt']); ?>
                        </p>
                        
                        <?php if ($post['tags']): ?>
                            <div style="margin-bottom: 1rem;">
                                <?php 
                                $tags = json_decode($post['tags'], true);
                                if ($tags):
                                    foreach ($tags as $tag): ?>
                                        <span style="background: rgba(255, 87, 34, 0.2); color: var(--primary-orange); padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; margin-right: 0.5rem;"><?php echo htmlspecialchars($tag); ?></span>
                                    <?php endforeach;
                                endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <a href="blog-post.php?slug=<?php echo urlencode($post['slug']); ?>" 
                           class="service-link">Read More →</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 3rem 0;">
                <h3 style="color: #ccc;">Coming Soon!</h3>
                <p style="color: #999;">We're working on bringing you the latest insights. Check back soon!</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter Signup -->
<section class="cta-section">
    <div class="container">
        <h2>Stay Updated with HirMatic Insights</h2>
        <p>Get the latest recruitment trends, career tips, and AI insights delivered to your inbox</p>
        
        <div style="max-width: 500px; margin: 2rem auto;">
            <form style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; justify-content: center;">
                <input type="email" name="email" placeholder="Enter your email" required 
                       style="flex: 1; min-width: 250px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; padding: 12px; color: white; font-size: 1rem;">
                <button type="submit" class="cta-button" style="white-space: nowrap;">
                    Subscribe
                </button>
            </form>
        </div>
        
        <div style="margin-top: 2rem;">
            <a href="contact.php" class="cta-button-secondary">Contact Our Experts</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
