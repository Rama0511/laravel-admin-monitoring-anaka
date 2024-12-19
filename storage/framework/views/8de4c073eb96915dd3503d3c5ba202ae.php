

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Konsultasi</h1>

    <form action="<?php echo e(route('konsultasi.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for="user">Pilih User:</label>
        <select name="email" id="user" required>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user['fields']['email']['stringValue']); ?>"><?php echo e($user['fields']['email']['stringValue']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit">Tampilkan Konsultasi</button>
    </form>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(isset($konsultasi)): ?>
        <h2>Konsultasi untuk <?php echo e($konsultasi['fields']['userId']['string Value']); ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $konsultasi['documents']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($k['fields']['catatan']['stringValue']); ?></td>
                        <td><?php echo e($k['fields']['status']['stringValue']); ?></td>
                        <td>
                            <?php if($k['fields']['status']['stringValue'] === 'Belum Dilakukan'): ?>
                                <form action="<?php echo e(route('konsultasi.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="email" value="<?php echo e($k['fields']['userId']['stringValue']); ?>">
                                    <input type="text" name="catatan" placeholder="Catatan" required>
                                    <button type="submit">Lakukan Konsultasi</button>
                                </form>
                            <?php else: ?>
                                <a href="<?php echo e(route('konsultasi.edit', ['email' => $k['fields']['userId']['stringValue']])); ?>">Edit</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-admin-project\laravel-admin-project 17 Desember 2024\resources\views/konsultasi/index.blade.php ENDPATH**/ ?>