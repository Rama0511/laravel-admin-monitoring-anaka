

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Konsultasi untuk <?php echo e($email); ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th>Konsultasi Ke</th>
                <th>Catatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $konsultasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td> <!-- Menampilkan nomor konsultasi -->
                    <td><?php echo e($item['fields']['catatan']['stringValue']); ?></td>
                    <td><?php echo e($item['fields']['status']['stringValue']); ?></td>
                    <td>
                        <?php if($item['fields']['status']['stringValue'] === 'Belum Konsultasi'): ?>
                            <form action="<?php echo e(route('konsultasi.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="email" value="<?php echo e($email); ?>">
                                <input type="text" name="catatan" placeholder="Catatan" required>
                                <button type="submit">Lakukan Konsultasi</button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('konsultasi.edit', $email)); ?>">Edit</a>
                        <?php endif; ?>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-admin-project\laravel-admin-project 17 Desember 2024\resources\views/konsultasi/show.blade.php ENDPATH**/ ?>