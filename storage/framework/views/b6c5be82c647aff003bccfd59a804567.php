

<?php $__env->startSection('content'); ?>
    <h2 class="section-title">// <span>Edit</span> Hardware Parameters</h2>

    <div style="max-width: 600px;">
        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 2.5rem;">
            <form method="POST" action="<?php echo e(route('admin.products.update', $product)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $product->name)); ?>" required placeholder="e.g. AMD Ryzen 9 9950X">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Price (RM)</label>
                <input type="number" name="price" class="form-control" step="0.01" min="0" value="<?php echo e(old('price', $product->price)); ?>" required placeholder="0.00">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Image Label</label>
                <input type="text" name="image_label" class="form-control" value="<?php echo e(old('image_label', $product->image_label)); ?>" placeholder="e.g. CPU, GPU, RAM (auto-generated if empty)">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Stock Quantity</label>
                <input type="number" name="stock" class="form-control" min="0" value="<?php echo e(old('stock', $product->stock)); ?>" required>

                <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                    <button type="submit" class="btn btn-primary" style="flex:1;">Update Parameters</button>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline" style="flex:1; text-align: center;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/admin/edit-product.blade.php ENDPATH**/ ?>