

<?php $__env->startSection('content'); ?>
    <h2 class="section-title" style="color: var(--danger);">// <span>Voucher</span> Management</h2>

    <div style="margin-bottom: 2rem;">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline">&laquo; Back to Dashboard</a>
    </div>

    <?php if($vouchers->isEmpty()): ?>
        <p style="color: var(--text-muted); font-family: monospace;">No vouchers found in the system.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Min Order</th>
                    <th>Usage</th>
                    <th>Expires</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="font-family: monospace; color: var(--accent);"><?php echo e($voucher->code); ?></td>
                        <td style="font-family: monospace;">RM <?php echo e(number_format($voucher->discount_amount, 2)); ?></td>
                        <td style="font-family: monospace;">RM <?php echo e(number_format($voucher->min_order_amount, 2)); ?></td>
                        <td style="font-family: monospace;"><?php echo e($voucher->times_used); ?> / <?php echo e($voucher->max_uses ?? '∞'); ?></td>
                        <td>
                            <?php if($voucher->expires_at): ?>
                                <?php echo e($voucher->expires_at->format('d M Y')); ?>

                                <?php if($voucher->expires_at->isPast()): ?>
                                    <span style="color: var(--danger); font-size: 0.75rem;">(EXPIRED)</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span style="color: var(--text-muted);">No expiry</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($voucher->isValid()): ?>
                                <span class="status status-ok">ACTIVE</span>
                            <?php else: ?>
                                <span class="status" style="color: var(--danger); border-color: var(--danger);">INACTIVE</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div style="margin-top: 1rem;">
            <?php echo e($vouchers->links('partials.pagination')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/admin/vouchers.blade.php ENDPATH**/ ?>