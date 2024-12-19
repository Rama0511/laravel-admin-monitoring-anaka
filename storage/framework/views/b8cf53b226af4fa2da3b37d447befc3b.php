

<?php $__env->startSection('title', 'Daftar Konsultasi'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="mt-5 text-center"><i class="fa-solid fa-notes-medical" style="color: #d5006d;"></i> Daftar Konsultasi</h2>
    <p class="text-center">Informasi tentang konsultasi anak-anak.</p>

    <!-- Form untuk memilih pengguna -->
    <form action="<?php echo e(route('consultation.index')); ?>" method="GET" class="mb-4">
        <div class="form-group">
            <label for="user_email">Pilih Pengguna:</label>
            <select name="user_email" id="user_email" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user['fields']['email']['stringValue']); ?>"><?php echo e($user['fields']['email']['stringValue']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan Konsultasi</button>
    </form>

    <!-- Menampilkan konsultasi jika ada -->
    <?php if(isset($consultations) && count($consultations) > 0): ?>
        <h2>Konsultasi untuk <?php echo e($selectedUser); ?></h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $consultations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td> <!-- Menampilkan nomor urut -->
                        <td><?php echo e($consultation['fields']['catatan']['stringValue']); ?></td>
                        <td><?php echo e($consultation['fields']['status']['stringValue']); ?></td>
                        <td>
                            <?php if($consultation['fields']['status']['stringValue'] == 'Belum Dilakukan'): ?>
                                <form action="<?php echo e(route('consultation.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="email" value="<?php echo e($selectedUser); ?>">
                                    <input type="hidden" name="consultation_id" value="<?php echo e($consultation['name']); ?>">
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan:</label>
                                        <input type="text" name="catatan" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-2">Lakukan Konsultasi</button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('consultation.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="email" value="<?php echo e($selectedUser); ?>">
                                    <input type="hidden" name="consultation_id" value="<?php echo e($consultation['name']); ?>">
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan:</label>
                                        <input type="text" name="catatan" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-2">Edit Catatan Konsultasi</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning mt-3" role="alert">
            Tidak ada konsultasi yang tersedia untuk pengguna yang dipilih.
        </div>
    <?php endif; ?>

    <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-primary mt-4"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-admin-project\laravel-admin-project 17 Desember 2024\resources\views/consultation/index.blade.php ENDPATH**/ ?>