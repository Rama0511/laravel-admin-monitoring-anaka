

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
            <?php $__currentLoopData = $konsultasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $konsul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td> <!-- Menampilkan nomor konsultasi -->
                    <td><?php echo e($konsul['fields']['catatan']['stringValue']); ?></td>
                    <td><?php echo e($konsul['fields']['status']['stringValue']); ?></td>
                    <td>
                        <?php if($konsul['fields']['status']['stringValue'] === 'Belum Konsultasi'): ?>
                            <form action="<?php echo e(route('konsultasi.store', ['email' => $email])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="konsultasi_ke" value="<?php echo e($index + 1); ?>"> <!-- Menambahkan input tersembunyi untuk nomor konsultasi -->
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Konfirmasi Konsultasi</button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('konsultasi.edit', ['email' => $email, 'konsultasiId' => basename($konsul['name'])])); ?>" class="btn btn-warning">Edit</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-admin-project\laravel-admin-project 17 Desember 2024\resources\views/konsultasi/form.blade.php ENDPATH**/ ?>