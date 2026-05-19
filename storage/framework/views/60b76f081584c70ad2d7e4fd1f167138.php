

<?php $__env->startSection('content'); ?>
    <div style="max-width: 500px; margin: 4rem auto;">
        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 3rem;">
            <h2 style="text-align: center; margin-bottom: 0.5rem;">CREATE <span style="color: var(--accent);">ACCOUNT</span></h2>
            <p style="text-align: center; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 2.5rem;">Register a new operator profile</p>

            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Operator Callsign</label>
                <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required autofocus placeholder="Enter callsign...">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required placeholder="operator@overclockhub.com">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Security Key (Password)</label>
                <input type="password" name="password" class="form-control" required placeholder="Minimum 8 characters...">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Confirm Security Key</label>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Re-enter security key...">

                <button type="submit" class="btn btn-primary w-100" style="margin-top: 0.5rem;">Register Operator <i data-lucide="chevron-right" style="width: 1.2rem; height: 1.2rem; margin-left: 0.5rem;"></i></button>
            </form>

            <p style="text-align: center; margin-top: 1.5rem;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Already registered?</span>
                <a href="<?php echo e(route('login')); ?>" style="color: var(--accent); font-size: 0.85rem; font-weight: 700;">Login Here</a>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/auth/register.blade.php ENDPATH**/ ?>