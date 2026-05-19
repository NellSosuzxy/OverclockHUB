<?php if($filteredOrders->isEmpty()): ?>
    <p style="color: var(--text-muted); font-family: monospace;">No orders match this filter.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Trace ID</th>
                <th>Date</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $filteredOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="font-family: monospace; color: var(--accent);"><?php echo e($order->trace_id); ?></td>
                    <td><?php echo e($order->created_at->format('d M Y, H:i')); ?></td>
                    <td>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="margin-bottom: 0.3rem;">
                                <span><?php echo e($item->product_name); ?></span>
                                <span style="color: var(--text-muted);"> x<?php echo e($item->quantity); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td style="font-family: monospace; font-weight: 700;">RM <?php echo e(number_format($order->total, 2)); ?></td>
                    <td>
                        <?php if($order->status === 'delivered'): ?>
                            <span class="status status-ok"><?php echo e(strtoupper($order->status)); ?></span>
                        <?php else: ?>
                            <span class="status status-warn"><?php echo e(strtoupper($order->status)); ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/partials/order-table.blade.php ENDPATH**/ ?>