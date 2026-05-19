

<?php $__env->startSection('content'); ?>
<h2 class="section-title">// <span>System</span> Gallery</h2>
<p style="color: var(--text-muted); margin-bottom: 3rem; text-align: center;">Visual records of deployed operational hardware and custom configurations.</p>

<style>
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto 4rem auto;
    }
    
    .gallery-item {
        background-color: var(--bg-card);
        border: 1px solid var(--border);
        overflow: hidden;
        border-radius: 4px;
        transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
        box-shadow: 0 10px 20px rgba(0, 240, 255, 0.1);
    }
    
    .gallery-item:hover .gallery-media {
        transform: scale(1.05);
    }

    .gallery-media {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
        border-bottom: 1px solid var(--border);
        transition: transform 0.5s ease;
    }

    .gallery-info {
        padding: 1.5rem;
    }

    .gallery-info h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1.1rem;
        color: var(--text-main);
    }

    .gallery-info p {
        margin: 0;
        font-size: 0.85rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .badge-video {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: var(--accent);
        border: 1px solid var(--accent);
        padding: 0.3rem 0.6rem;
        font-family: monospace;
        font-size: 0.75rem;
        font-weight: bold;
        border-radius: 4px;
        backdrop-filter: blur(4px);
    }
</style>

<div class="gallery-grid">
    
    <!-- Video Item 1 -->
    <div class="gallery-item stagger-item">
        <span class="badge-video">LIVE FEED // 01</span>
        <video autoplay loop muted playsinline class="gallery-media">
            <source src="<?php echo e(asset('videos/Left.mp4')); ?>" type="video/mp4">
        </video>
        <div class="gallery-info">
            <h3>Project: TITAN</h3>
            <p>Custom dual-loop water cooling loop featuring Intel Core i9 and dual RTX 4090 architecture. Built for deep learning computational tasks.</p>
        </div>
    </div>

    <!-- Image Item 1 -->
    <div class="gallery-item stagger-item">
        <img src="<?php echo e(asset('images/PC close up 1.avif')); ?>" loading="lazy" alt="PC Close up" class="gallery-media">
        <div class="gallery-info">
            <h3>Macro Hardware Diagnostics</h3>
            <p>Close-up inspection of motherboard power delivery (VRM) phase components and memory seating prior to chassis installation.</p>
        </div>
    </div>

    <!-- Video Item 2 -->
    <div class="gallery-item stagger-item">
        <span class="badge-video">LIVE FEED // 02</span>
        <video autoplay loop muted playsinline class="gallery-media">
           <source src="<?php echo e(asset('videos/RGB sync.mp4')); ?>" type="video/mp4">
        </video>
        <div class="gallery-info">
            <h3>RGB Synchronization Sequence</h3>
            <p>Testing phase of full-spectrum addressable RGB synchronization across all localized fan arrays and memory heatsinks.</p>
        </div>
    </div>

    <!-- Image Item 2 -->
    <div class="gallery-item stagger-item">
        <img src="<?php echo e(asset('images/PC close up 2.avif')); ?>" loading="lazy" alt="PC Components" class="gallery-media">
        <div class="gallery-info">
            <h3>Airflow Architecture</h3>
            <p>Demonstrating strict cable management and optimal positive pressure airflow setups inside mid-tower environments.</p>
        </div>
    </div>

    <!-- Image Item 3 -->
    <div class="gallery-item stagger-item">
        <img src="<?php echo e(asset('images/Custom keyboard.jpg')); ?>" loading="lazy" alt="Custom Keyboard" class="gallery-media">
        <div class="gallery-info">
            <h3>Enthusiast Mechanical Keyboards</h3>
            <p>Premium custom mechanical keyboard builds featuring lubricated tactile switches and specialized acoustic dampening materials.</p>
        </div>
    </div>

    <!-- Image Item 4 -->
    <div class="gallery-item stagger-item">
        <img src="<?php echo e(asset('images/Custom cooling.jpg')); ?>" loading="lazy" alt="Custom Cooling" class="gallery-media">
        <div class="gallery-info">
            <h3>Custom Liquid Cooling</h3>
            <p>Precision-engineered hardline liquid cooling loops designed to sustain peak thermal performance under heavy overclocking workloads.</p>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/gallery.blade.php ENDPATH**/ ?>