

<?php $__env->startSection('content'); ?>
    <h2 class="section-title">// Hardware <span>Queue</span></h2>

    <?php if($cartItems->isEmpty()): ?>
        <div style="text-align: center; padding: 4rem 0; border: 1px dashed var(--border); background-color: var(--bg-card); margin-top: 2rem;">
            <div style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"><i data-lucide="shopping-cart" style="width: 4rem; height: 4rem;"></i></div>
            <p style="color: var(--text-muted); font-family: monospace; font-size: 1.2rem; margin-bottom: 2rem;">Queue is empty. Browse hardware to add items.</p>
            <a href="<?php echo e(route('home')); ?>" class="btn btn-primary" style="padding: 1rem 2rem;">Return to Terminal</a>
        </div>
    <?php else: ?>
        <div class="cart-grid">
            <div class="table-responsive" style="overflow-x: auto;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Component</th>
                            <th>Unit Price</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Subtotal</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover-bg-alt" style="transition: background-color 0.2s;">
                                <td>
                                    <strong style="color: var(--accent);"><?php echo e($item->product->name); ?></strong>
                                    <br><span style="color: var(--text-muted); font-size: 0.8rem; font-family: monospace;">SKU: <?php echo e($item->product->sku); ?></span>
                                    <?php if($item->quantity >= $item->product->stock): ?>
                                        <br><span style="color: var(--warning); font-size: 0.75rem; font-weight: bold;">Max Stock Reached</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-family: monospace; opacity: 0.8;">RM <?php echo e(number_format($item->product->price, 2)); ?></td>
                                <td style="text-align: center;">
                                    <form method="POST" action="<?php echo e(route('cart.update', $item)); ?>" style="display: inline-flex; gap: 0.5rem; justify-content: center;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" max="<?php echo e($item->product->stock); ?>" class="form-control" style="width: 70px; margin-bottom: 0; padding: 0.5rem; text-align: center; border-color: var(--border);">
                                        <button type="submit" class="btn btn-outline" style="padding: 0.5rem 0.75rem; font-size: 0.75rem;">Set</button>
                                    </form>
                                </td>
                                <td style="font-family: monospace; color: var(--text-main); font-weight: bold; text-align: right;">RM <?php echo e(number_format($item->product->price * $item->quantity, 2)); ?></td>
                                <td style="text-align: center;">
                                    <form method="POST" action="<?php echo e(route('cart.destroy', $item)); ?>" onsubmit="return confirm('Remove hardware from queue?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger" style="padding: 0.5rem 0.75rem; font-size: 0.75rem;">X</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="checkout-panel" style="position: sticky; top: 100px;">
                <h3 style="margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; color: var(--accent);">Order Summary</h3>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: var(--text-muted);">Subtotal (<?php echo e($cartItems->sum('quantity')); ?> items)</span>
                    <span style="font-family: monospace;">RM <?php echo e(number_format($subtotal, 2)); ?></span>
                </div>

                <?php if($appliedVoucher): ?>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: var(--success); padding: 0.5rem; background: rgba(0, 255, 102, 0.1); border-left: 2px solid var(--success);">
                        <span>Code Applied: <?php echo e(strtoupper($appliedVoucher->code)); ?></span>
                        <span style="font-family: monospace;">-RM <?php echo e(number_format($discount, 2)); ?></span>
                    </div>
                <?php endif; ?>

                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: var(--text-muted);">Logistics Fee</span>
                    <span style="font-family: monospace; color: <?php echo e($shippingFee == 0 ? 'var(--success)' : 'inherit'); ?>;">
                        <?php echo e($shippingFee == 0 ? 'STATUS: WAIVED' : 'RM ' . number_format($shippingFee, 2)); ?>

                    </span>
                </div>

                <?php if($shippingFee > 0): ?>
                    <div style="height: 4px; background: var(--bg-main); margin-bottom: 0.5rem; border-radius: 2px; overflow: hidden;">
                        <div style="height: 100%; width: <?php echo e(min(($subtotal / 5000) * 100, 100)); ?>%; background: var(--accent);"></div>
                    </div>
                    <p style="color: var(--accent); font-size: 0.75rem; margin-bottom: 1.5rem; text-align: right;">
                        Add RM <?php echo e(number_format(5000 - $subtotal, 2)); ?> for Free Logistics
                    </p>
                <?php else: ?>
                    <p style="color: var(--success); font-size: 0.75rem; margin-bottom: 1.5rem; text-align: right; font-weight: bold;">
                        Valid for Free Express Logistics
                    </p>
                <?php endif; ?>

                <div style="margin-bottom: 1.5rem; padding: 1rem; background: var(--bg-main); border: 1px solid var(--border);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Delivery Coordinates</span>
                        <a href="<?php echo e(route('profile.edit')); ?>" style="color: var(--accent); font-size: 0.75rem; text-decoration: none;">[ EDIT ]</a>
                    </div>
                    <?php if(trim((string) Auth::user()->address) !== ''): ?>
                        <p style="font-family: monospace; font-size: 0.85rem; color: var(--text-main); margin: 0; white-space: pre-line;"><?php echo e(Auth::user()->address); ?></p>
                    <?php else: ?>
                        <p style="font-family: monospace; font-size: 0.85rem; color: var(--danger); margin: 0; font-weight: bold;">NO ADDRESS CONFIGURED</p>
                    <?php endif; ?>
                </div>

                <div style="display: flex; justify-content: space-between; padding-top: 1.5rem; border-top: 1px dashed var(--border); margin-bottom: 2rem;">
                    <span style="font-weight: 900; font-size: 1.2rem;">TOTAL AUTHORIZATION</span>
                    <span style="font-family: monospace; font-size: 1.6rem; color: var(--accent);">RM <?php echo e(number_format($total, 2)); ?></span>
                </div>

                <form method="POST" action="<?php echo e(route('cart.voucher')); ?>" style="margin-bottom: 2rem; background: var(--bg-main); padding: 1rem; border: 1px solid var(--border);">
                    <?php echo csrf_field(); ?>
                    <label style="display:block; color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Access Code (Voucher)</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" name="voucher_code" class="form-control" placeholder="ENTER CODE..." style="margin-bottom: 0; text-transform: uppercase;" value="<?php echo e($appliedVoucher->code ?? ''); ?>" required>
                        <button type="submit" class="btn btn-outline" style="white-space: nowrap;">Apply</button>
                    </div>
                    <?php if($appliedVoucher): ?>
                        <small style="display: block; margin-top: 0.5rem; color: var(--success);">Valid code applied.</small>
                    <?php endif; ?>
                </form>

                <a href="<?php echo e(route('checkout.page')); ?>" class="btn btn-primary w-100" style="padding: 1rem; font-size: 1rem; text-align: center;">PROCEED TO SECURE PAYMENT <i data-lucide="shield-check" style="width: 1.2rem; height: 1.2rem; margin-left: 0.5rem; vertical-align: middle;"></i></a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/cart.blade.php ENDPATH**/ ?>