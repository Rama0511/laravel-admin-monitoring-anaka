<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="baby-carriage-solid.svg" type="x-icon">
        <title>Detail Informasi User</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet"></body>
    </head>
    <body>
        <div class="container">
            <h2 class="mt-5 text-center"><i class="fas fa-users" style="color: #d5006d;"></i> Informasi User</h2>
            <p class="text-center">Informasi detail user.</p>
            <?php if(isset($detail) && count($detail) > 0): ?>
                <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <table class="table table-bordered mt-3">
                        <tr>
                            <td>Nama Suami</td>
                            <td>:</td>
                            <td><?php echo e($child['fields']['suami']['stringValue']); ?></td>
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
                            <td>No. Telepon</td>
                            <td>:</td>
                            <td><?php echo e($child['fields']['No. Telepon']['stringValue']); ?></td>
                        </tr>
                    </table>
                    <div style="display: flex;">
                        <a href="<?php echo e(route('children', ['email' => $child['fields']['email']['stringValue']])); ?>" class="btn btn-info"><i class="fas fa-child"></i> Lihat Data Anak</a>
                        <a href="<?php echo e(route('twins', ['email' => $child['fields']['email']['stringValue']])); ?>" class="btn btn-info"><i class="fas fa-child"></i> Lihat Data Anak Kembar</a>
                        <a href="<?php echo e(route('perkiraan', ['email' => $child['fields']['email']['stringValue']])); ?>" class="btn btn-success"><i class="fa fa-person-pregnant"></i> Lihat Perkiraan Kelahiran </a>
                        <a href="<?php echo e(route('perkembangan1', ['email' => $child['fields']['email']['stringValue']])); ?>" class="btn btn-success"><i class="fa-solid fa-person-breastfeeding"></i> Lihat Perkembangan Anak </a>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#noDataModal">Data Anak Kosong</button>
                    </td>
                </tr>
            <?php endif; ?>

            <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
        </div>
    </body>
    <script src="https://kit.fontawesome.com/a3d23530e5.js" crossorigin="anonymous"></script>
</html>




<?php /**PATH C:\xampp\htdocs\laravel-admin-project\resources\views/detail.blade.php ENDPATH**/ ?>