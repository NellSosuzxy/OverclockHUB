<?php if($paginator->hasPages()): ?>
    <nav style="display: flex; justify-content: center; gap: 0.5rem; align-items: center;">
        
        <?php if($paginator->onFirstPage()): ?>
            <span class="btn btn-outline" style="opacity: 0.3; cursor: not-allowed; padding: 0.5rem 1rem; font-size: 0.8rem;">&laquo; Prev</span>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;">&laquo; Prev</a>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_string($element)): ?>
                <span style="color: var(--text-muted); padding: 0.5rem;"><?php echo e($element); ?></span>
            <?php endif; ?>

            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <span class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;"><?php echo e($page); ?></span>
                    <?php else: ?>
                        <a href="<?php echo e($url); ?>" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;"><?php echo e($page); ?></a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Next &raquo;</a>
        <?php else: ?>
            <span class="btn btn-outline" style="opacity: 0.3; cursor: not-allowed; padding: 0.5rem 1rem; font-size: 0.8rem;">Next &raquo;</span>
        <?php endif; ?>
    </nav>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/partials/pagination.blade.php ENDPATH**/ ?>