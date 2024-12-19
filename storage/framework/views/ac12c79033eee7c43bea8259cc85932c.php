

<?php $__env->startSection('title', 'Daftar Imunisas'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="mt-5 text-center"><i class="fa-solid fa-syringe" style="color: #d5006d;"></i> Daftar Imunisas</h2>
    <p class="text-center">Informasi tentang imunisasi anak-anak.</p>


    <form action="<?php echo e(route('imunisasi.index')); ?>" method="GET" class="mb-4">
        <div class="form-group">
            <label for="user_email">Pilih Pengguna:</label>
            <select name="user_email" id="user_email" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user['fields']['email']['stringValue']); ?>"><?php echo e($user['fields']['email']['stringValue']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan Imunisas</button>
    </form>

    <?php if(isset($imunisasis) && count($imunisasis) > 0): ?>
        <h2>Imunisas untuk <?php echo e($selectedUser); ?></h2>
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
                <?php $__currentLoopData = $imunisasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imunisasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td> 
                        <td><?php echo e($imunisasi['fields']['catatan']['stringValue']); ?></td>
                        <td><?php echo e($imunisasi['fields']['status']['stringValue']); ?></td>
                        <td>
                            <?php if($imunisasi['fields']['status']['stringValue'] == 'Belum Dilakukan'): ?>
                                <form action="<?php echo e(route('imunisasi.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="email" value="<?php echo e($selectedUser); ?>">
                                    <input type="hidden" name="imunisasi_id" value="<?php echo e($imunisasi['name']); ?>">
                                    <input type="hidden" name="catatan_jd" value="<?php echo e($imunisasi['fields']['catatan']['stringValue']); ?>">
                                    <input type="hidden" name="id_catatan" value="<?php echo e($loop->iteration); ?>">
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan:</label>
                                        <input type="text" name="catatan" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-2">Lakukan Imunisas</button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('imunisasi.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="email" value="<?php echo e($selectedUser); ?>">
                                    <input type="hidden" name="imunisasi_id" value="<?php echo e($imunisasi['name']); ?>">
                                    <input type="hidden" name="catatan_jd" value="<?php echo e($imunisasi['fields']['catatan']['stringValue']); ?>">
                                    <input type="hidden" name="id_catatan" value="<?php echo e($loop->iteration); ?>">
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan:</label>
                                        <input type="text" name="catatan" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-2">Edit catatan Imunisas</button>
                                </form> 
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning mt-3" role="alert">
            Tidak ada imunisasi yang tersedia untuk pengguna yang dipilih.
        </div>
    <?php endif; ?>

    <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-primary mt-4"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-admin-project\laravel-admin-project 17 Desember 2024\resources\views/imunisasi/index.blade.php ENDPATH**/ ?>