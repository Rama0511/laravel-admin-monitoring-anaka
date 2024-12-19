<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Perkiaraan Kelahiran</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet"></body>
        <script src="https://kit.fontawesome.com/a3d23530e5.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <h2 class="mt-5 text-center"><i class="fa fa-person-pregnant" style="color: #d5006d;"></i> Informasi Perkiraan Kelahiran</h2>
            <p class="text-center">Informasi perkiraan kelahiran user.</p>
            <?php if(isset($perkiraan) && count($perkiraan) > 0): ?>
                <?php $__currentLoopData = $perkiraan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <table class="table table-bordered mt-1">
                        <tr>
                            <th>Periode Kehamilan</th>
                            <th>:</th>
                            <th><?php echo e($child['fields']['periode_kehamilan']['stringValue']); ?></th>
                        </tr>
                        <tr>
                            <td>Nama Istri</td>
                            <td>:</td>
                            <td><?php echo e($child['fields']['istri']['stringValue']); ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo e($child['fields']['email']['stringValue']); ?></td>
                        </tr>
                        <tr>
                            <td>Riwayat Medis</td>
                            <td>:</td>
                            <td><?php echo e($child['fields']['riwayat_medis']['stringValue']); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Haid Terakhir</td>
                            <td>:</td>
                            <td><?php echo e((new \DateTime($child['fields']['tanggal_haid']['stringValue']))->format('d F Y')); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Perkiraan Kelahiran</td>
                            <td>:</td>
                            <td><?php echo e((new \DateTime($child['fields']['perkiraan_kelahiran']['stringValue']))->format('d F Y')); ?></td>
                        </tr>
                    </table>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#noDataModal">Data Perkiaraan Kelahiran Kosong</button><br>
                    </td>
                </tr>
            <?php endif; ?>

            <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
        </div>
    </body>
    <script src="https://kit.fontawesome.com/a3d23530e5.js" crossorigin="anonymous"></script>
</html>




<?php /**PATH C:\xampp\htdocs\laravel-admin-project\resources\views/perkiraan.blade.php ENDPATH**/ ?>