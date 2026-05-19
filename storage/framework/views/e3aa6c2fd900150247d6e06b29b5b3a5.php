

<?php $__env->startSection('content'); ?>
    <div style="max-width: 500px; margin: 4rem auto;">
        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 3rem;">
            <h2 style="text-align: center; margin-bottom: 0.5rem;">SYSTEM <span style="color: var(--accent);">LOGIN</span></h2>
            <p style="text-align: center; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 2.5rem;">Authenticate to access your terminal session</p>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required autofocus placeholder="operator@overclockhub.com" autocomplete="off">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Security Key (Password)</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter security key..." autocomplete="off">

                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> style="accent-color: var(--accent);">
                    <label for="remember" style="color: var(--text-muted); font-size: 0.85rem; cursor:pointer;">Persist Session</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Initialize Session <i data-lucide="chevron-right" style="width: 1.2rem; height: 1.2rem; margin-left: 0.5rem;"></i></button>
            </form>

            <p style="text-align: center; margin-top: 1.5rem;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">New operator?</span>
                <a href="<?php echo e(route('register')); ?>" style="color: var(--accent); font-size: 0.85rem; font-weight: 700;">Create Account</a>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/auth/login.blade.php ENDPATH**/ ?>