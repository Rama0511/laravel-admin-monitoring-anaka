<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Anak</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
    </head>
    <body>
        <div class="container">
            <h2 class="mt-5 text-center"><i class="fas fa-child" style="color: #d5006d;"></i> Data Anak</h2>
            <p class="text-center">Informasi tentang anak-anak.</p>

            <table class="table table-bordered mt-3" id="childrenTable">
                <thead>
                    <tr>
                        <th>Nama Anak</th>
                        <th>Jenis Kelamin</th>
                        <th>Tinggi Badan</th>
                        <th>Berat Badan</th>
                        <th>Status Gizi</th>
                        <th>Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($children) && count($children) > 0): ?>
                        <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($child['fields']['name']['stringValue']); ?></td>
                                <td><?php echo e($child['fields']['gender']['stringValue']); ?></td>
                                <td><?php echo e($child['fields']['height']['integerValue']); ?></td>
                                <td><?php echo e($child['fields']['weight']['integerValue']); ?></td>
                                <td><?php echo e($child['fields']['nutritionStatus']['stringValue']); ?></td>
                                <td><?php echo e($child['fields']['birthDate']['stringValue']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#noDataModal">Data Anak Kosong</button>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
        </div>
    </body>
</html>




<?php /**PATH C:\xampp\htdocs\laravel-login-project\resources\views/children.blade.php ENDPATH**/ ?>