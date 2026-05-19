


<?php $__env->startSection('content'); ?>
    
    <section class="hero hero-section mb-5" style="background: var(--bg-main); overflow: hidden; padding-top: 10rem; padding-bottom: 10rem;">
        <!-- Background Cinematic Video -->
        <video autoplay loop muted playsinline class="hero-video">
            <source src="<?php echo e(asset('videos/Home.mp4')); ?>" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>

        <!-- Foreground Content -->
        <div style="position: relative; z-index: 2;">
            <h1>COMMAND YOUR <span style="color: var(--accent);">BUILD</span></h1>
            <p>Elite-grade computing hardware, engineered for maximum throughput. Browse our arsenal of high-performance components.</p>
            <a href="<?php echo e(route('catalog', 'cpu')); ?>" class="btn btn-primary" style="margin-top: 1.5rem;">Initiate Build</a>
        </div>
    </section>

    <section class="quick-access-section" style="margin-bottom: 4rem;">
        <h2 class="section-title">// <span>Quick Access</span> Terminals</h2>
        
        <?php if($categories->count() > 0): ?>
            <div class="grid-7 category-grid">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('catalog', $category->slug)); ?>" class="cat-img-card stagger-item bg-<?php echo e($category->image_class ?? 'default'); ?>">
                        <span><?php echo e($category->name); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info" style="border: 1px solid var(--border); color: var(--text-muted); text-align: center; margin-top: 2rem;">
                Terminal categories offline. Awaiting system synchronization.
            </div>
        <?php endif; ?>
    </section>

    <section class="metrics-section" style="margin-bottom: 4rem;">
        <h2 class="section-title">// Operational <span>Metrics</span></h2>
        <div class="grid-4 features-grid">
            <div class="feature-box stagger-item">
                <h1 style="color: var(--accent); margin-bottom: 1rem; font-size: 2rem;"><i data-lucide="zap" style="width: 3rem; height: 3rem;"></i></h1>
                <h3>Express Logistics</h3>
                <p>Free express delivery on orders over RM 5,000</p>
            </div>
            <div class="feature-box stagger-item">
                <h1 style="color: var(--accent); margin-bottom: 1rem; font-size: 2rem;"><i data-lucide="lock" style="width: 3rem; height: 3rem;"></i></h1>
                <h3>Encrypted Checkout</h3>
                <p>Full end-to-end encrypted payment processing</p>
            </div>
            <div class="feature-box stagger-item">
                <h1 style="color: var(--accent); margin-bottom: 1rem; font-size: 2rem;"><i data-lucide="headphones" style="width: 3rem; height: 3rem;"></i></h1>
                <h3>24/7 Operations</h3>
                <p>Round-the-clock technical support &amp; diagnostics</p>
            </div>
            <div class="feature-box stagger-item">
                <h1 style="color: var(--accent); margin-bottom: 1rem; font-size: 2rem;"><i data-lucide="shield-check" style="width: 3rem; height: 3rem;"></i></h1>
                <h3>Verified Hardware</h3>
                <p>Every component tested &amp; validated before shipping</p>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/home.blade.php ENDPATH**/ ?>