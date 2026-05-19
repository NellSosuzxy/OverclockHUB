


<?php $__env->startSection('content'); ?>
    
    <h2 class="section-title">// <span><?php echo e($category->name); ?></span> Inventory</h2>

    <?php if($products->isEmpty()): ?>
        <div class="alert alert-info text-center" style="border: 1px solid var(--border); padding: 3rem;">
            <p style="color: var(--text-muted); font-family: monospace; font-size: 1.2rem; margin: 0;"><i data-lucide="triangle-alert" style="width: 1.2rem; height: 1.2rem; vertical-align: middle; margin-right: 0.5rem;"></i> No hardware found in this registry or currently out of stock.</p>
        </div>
    <?php else: ?>
        <div class="grid-4">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card hover-elevate stagger-item">
                    <div>
                        <div class="img-container">
                            <img src="<?php echo e(asset('images/' . $product->name . '.png')); ?>" alt="<?php echo e($product->name); ?>">
                        </div>
                        <h3 title="<?php echo e($product->name); ?>"><?php echo e($product->name); ?></h3>
                        <p style="color: <?php echo e($product->stock > 0 ? 'var(--success)' : 'var(--danger)'); ?>; font-size: 0.8rem; font-family: monospace; margin-bottom: 0.5rem;">
                            <?php echo e($product->sku); ?> &bull; <?php echo e($product->stock > 0 ? 'STATUS: IN STOCK (' . $product->stock . ')' : 'STATUS: DEPLETED'); ?>

                        </p>
                        <div class="price">RM <?php echo e(number_format($product->price, 2)); ?></div>
                    </div>
                    <div style="margin-top: 1.5rem;">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if($product->stock > 0): ?>
                                <form method="POST" action="<?php echo e(route('cart.add')); ?>" onsubmit="this.querySelector('button').disabled = true; this.querySelector('button').innerHTML = 'Processing...';">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <button type="submit" class="btn btn-primary w-100">Add to Queue</button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-outline w-100" disabled style="opacity: 0.4; cursor: not-allowed; border-color: var(--danger); color: var(--danger);">Depleted</button>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline w-100" style="text-align: center;">Login to Purchase</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div style="margin-top: 3rem; display: flex; justify-content: center;">
            <?php echo e($products->links('pagination::bootstrap-4')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/catalog.blade.php ENDPATH**/ ?>