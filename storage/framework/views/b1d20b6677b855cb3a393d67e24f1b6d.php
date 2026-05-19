

<?php $__env->startSection('content'); ?>
    <h2 class="section-title" style="color: var(--danger);">// <span>Support</span> Tickets</h2>

    <div style="margin-bottom: 2rem;">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline">&laquo; Back to Dashboard</a>
    </div>

    <?php if($tickets->isEmpty()): ?>
        <p style="color: var(--text-muted); font-family: monospace;">No support tickets found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reference</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="font-family: monospace; color: var(--accent);">#<?php echo e($ticket->id); ?></td>
                        <td><?php echo e($ticket->name); ?></td>
                        <td style="font-family: monospace; font-size: 0.85rem;"><?php echo e($ticket->email); ?></td>
                        <td style="font-family: monospace;"><?php echo e($ticket->reference_id ?? '—'); ?></td>
                        <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo e(Str::limit($ticket->message, 80)); ?></td>
                        <td><?php echo e($ticket->created_at->format('d M Y')); ?></td>
                        <td>
                            <?php if($ticket->status === 'resolved'): ?>
                                <span class="status status-ok">RESOLVED</span>
                            <?php elseif($ticket->status === 'in_progress'): ?>
                                <span class="status status-warn">IN PROGRESS</span>
                            <?php else: ?>
                                <span class="status" style="color: var(--accent); border-color: var(--accent);">OPEN</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="POST" action="<?php echo e(route('admin.tickets.update', $ticket)); ?>" style="display: flex; gap: 0.5rem; align-items: center;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <select name="status" class="form-control" style="width: auto; margin-bottom: 0; padding: 0.4rem 0.6rem; font-size: 0.8rem;">
                                    <option value="open" <?php echo e($ticket->status === 'open' ? 'selected' : ''); ?>>Open</option>
                                    <option value="in_progress" <?php echo e($ticket->status === 'in_progress' ? 'selected' : ''); ?>>In Progress</option>
                                    <option value="resolved" <?php echo e($ticket->status === 'resolved' ? 'selected' : ''); ?>>Resolved</option>
                                </select>
                                <button type="submit" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div style="margin-top: 1rem;">
            <?php echo e($tickets->links('partials.pagination')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/admin/support-tickets.blade.php ENDPATH**/ ?>