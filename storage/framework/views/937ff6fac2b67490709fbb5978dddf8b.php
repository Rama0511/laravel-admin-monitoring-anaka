

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Pilih User</h1>
    <form action="<?php echo e(route('konsultasi.index')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="user">Pilih User:</label>
            <select name="user" id="user" class="form-control" required>
                <option value="">-- Pilih User --</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user['fields']['email']['stringValue']); ?>">
                        <?php echo e($user['fields']['email']['stringValue']); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan Data Konsultasi</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-admin-project\laravel-admin-project 17 Desember 2024\resources\views/konsultasi/pilihUser.blade.php ENDPATH**/ ?>