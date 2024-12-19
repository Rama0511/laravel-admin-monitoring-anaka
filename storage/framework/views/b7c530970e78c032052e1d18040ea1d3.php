<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Perkembangan Anak</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8d7da;
            font-family: "Funnel Display", sans-serif; 
        }
        .container {
            background-color: #ffffff; 
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #d63384; 
        }
        .alert {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #d63384; 
            border: none;
        }
        .btn-primary:hover {
            background-color: #c8237a; 
        }
        .icon-container {
            text-align: center; /* Center the icon */
            margin-bottom: 20px; /* Add some space below the icon */
        }
        .icon-container i {
            font-size: 50px; /* Increase the size of the icon */
        }
    </style>
    <script src="https://kit.fontawesome.com/a3d23530e5.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="icon-container">
            <i class="fa-solid fa-person-breastfeeding" style="color: #d63384;"></i>
        </div>
        <h2 class="text-center">Data Perkembangan Anak</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Deskripsi</th>
                    <th>Berat</th>
                    <th>Tinggi</th>
                    <th>Lingkar Kepala</th>
                    <th>Vaksin Info</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($document['fields']['bulan']['integerValue'] ?? $document['fields']['bulan']['stringValue'] ?? 'N/A'); ?></td>
                        <td><?php echo e($document['fields']['deskripsi']['stringValue'] ?? 'N/A'); ?></td>
                        <td><?php echo e($document['fields']['berat']['stringValue'] ?? 'N/A'); ?></td>
                        <td><?php echo e($document['fields']['tinggi']['stringValue'] ?? 'N/A'); ?></td>
                        <td><?php echo e($document['fields']['lingkar_kepala']['stringValue'] ?? 'N/A'); ?></td>
                        <td><?php echo e($document['fields']['vaksin_info']['stringValue'] ?? 'N/A'); ?></td>
                        <td>
                            <?php if(isset($document['fields']['mom_notes']['arrayValue']['values'])): ?>
                                <?php $__currentLoopData = $document['fields']['mom_notes']['arrayValue']['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($note['stringValue']); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('perkembangan.edit', ['id' => basename($document['name'])])); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="<?php echo e(route('perkembangan.destroy', ['id' => basename($document['name'])])); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <h2 class="text-center mt-5">Form Perkembangan Anak</h2>
        <form action="<?php echo e(route('perkembangan.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="bulan">Bulan</label>
                <input type="number" class="form-control" id="bulan" name="bulan" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="berat">Berat</label>
                <input type="text" class="form-control" id="berat" name="berat" required>
            </div>
            <div class="form-group">
                <label for="tinggi">Tinggi</label>
                <input type="text" class="form-control" id="tinggi" name="tinggi" required>
            </div>
            <div class="form-group">
                <label for="lingkar_kepala">Lingkar Kepala</label>
                <input type="text" class="form-control" id="lingkar_kepala" name="lingkar_kepala" required>
            </div>
            <div class="form-group">
                <label for="vaksin_info">Informasi Vaksin</label>
                <input type="text" class="form-control" id="vaksin_info" name="vaksin_info">
            </div>
            <div class="form-group">
                <label for="mom_notes">Catatan Ibu (pisahkan dengan koma)</label>
                <input type="text" class="form-control" id="mom_notes" name="mom_notes[]" placeholder="Catatan 1">
                <input type="text" class="form-control mt-2" name="mom_notes[]" placeholder="Catatan 2">
                <input type="text" class="form-control mt-2" name="mom_notes[]" placeholder="Catatan 3">
            </div>
            <button type="submit" class="btn btn-primary">Kirim Data</button>
        </form>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel-admin-project\resources\views/perkembangan/create.blade.php ENDPATH**/ ?>