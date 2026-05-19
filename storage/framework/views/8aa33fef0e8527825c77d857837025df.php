

<?php $__env->startSection('content'); ?>
    <h2 class="section-title">// <span>Telemetry</span> — Order History</h2>

    <?php if($orders->isEmpty()): ?>
        <p style="color: var(--text-muted); font-family: monospace; padding: 2rem 0;">No orders found in system logs.</p>
    <?php else: ?>
        <div class="order-tabs">
            <span class="order-tab active" data-tab="all" onclick="switchOrderTab('all')">All Orders</span>
            <span class="order-tab" data-tab="queued" onclick="switchOrderTab('queued')">Queued</span>
            <span class="order-tab" data-tab="shipped" onclick="switchOrderTab('shipped')">Shipped</span>
            <span class="order-tab" data-tab="delivered" onclick="switchOrderTab('delivered')">Delivered</span>
        </div>

        <div id="tab-all" class="order-content active">
            <?php echo $__env->make('partials.order-table', ['filteredOrders' => $orders->getCollection()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div id="tab-queued" class="order-content">
            <?php echo $__env->make('partials.order-table', ['filteredOrders' => $orders->getCollection()->where('status', 'queued')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div id="tab-shipped" class="order-content">
            <?php echo $__env->make('partials.order-table', ['filteredOrders' => $orders->getCollection()->where('status', 'shipped')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div id="tab-delivered" class="order-content">
            <?php echo $__env->make('partials.order-table', ['filteredOrders' => $orders->getCollection()->where('status', 'delivered')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div style="margin-top: 2rem;">
            <?php echo e($orders->links('partials.pagination')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/orders.blade.php ENDPATH**/ ?>