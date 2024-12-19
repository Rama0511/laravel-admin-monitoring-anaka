<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="baby-carriage-solid.svg" type="x-icon">
        <title>Informasi Perkembangan Anak</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet"></body>
    </head>
    <body>
        <div class="container">
            <h2 class="mt-5 text-center"><i class="fas fa-child" style="color: #d5006d;"></i> Informasi Perkembangan Anak</h2>
            <p class="text-center">Informasi Perkembangan <?php echo e($nama); ?></p>

            <table class="table table-bordered mt-3" id="childrenTable">
                <tr>
                    <th>Deskripsi</th>
                    <td><?php echo e($data['fields']['deskripsi']['stringValue']); ?></td>
                </tr>
                <tr>
                    <th>Berat</th>
                    <td><?php echo e($data['fields']['berat']['stringValue']); ?></td>
                </tr>
                <tr>
                    <th>Tinggi</th>
                    <td><?php echo e($data['fields']['tinggi']['stringValue']); ?></td>
                </tr>
                <tr>
                    <th>Lingkar Kepala</th>
                    <td><?php echo e($data['fields']['lingkar_kepala']['stringValue']); ?></td>
                </tr>
                <tr>
                    <th>Vaksin Info</th>
                    <td><?php echo e($data['fields']['vaksin_info']['stringValue']); ?></td>
                </tr>
                <tr>
                    <th>Catatan Ibu</th>
                    <td>
                        <ul>
                            <?php if(isset($data['fields']['mom_notes']['arrayValue']['values']) && is_array($data['fields']['mom_notes']['arrayValue']['values'])): ?>
                                <?php $__currentLoopData = $data['fields']['mom_notes']['arrayValue']['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($note['stringValue'] ?? 'No value'); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li>No notes available.</li>
                            <?php endif; ?>
                        </ul>
                    </td>
                </tr>
            </table>

            <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali ke ke Dashboard</a>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-admin-project\resources\views/perkembangan2.blade.php ENDPATH**/ ?>