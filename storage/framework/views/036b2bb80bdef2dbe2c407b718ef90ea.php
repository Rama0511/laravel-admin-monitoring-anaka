<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Perkembangan Anak</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8d7da; /* Warna pink muda */
        }
        .container {
            background-color: #ffffff; /* Warna putih */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #d63384; /* Warna teks judul */
        }
        .alert {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #d63384; /* Warna tombol */
            border: none;
        }
        .btn-primary:hover {
            background-color: #c8237a; /* Warna tombol saat hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Perkembangan Anak</h2>

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

        <form action="<?php echo e(route('perkembangan.update', ['id' => basename($document['name'])])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?> <!-- Pastikan menggunakan PATCH untuk update -->
            <div class="form-group">
                <label for="bulan">Bulan</label>
                <input type="number" class="form-control" id="bulan" name="bulan" value="<?php echo e($document['fields']['bulan']['stringValue'] ?? $document['fields']['bulan']['integerValue']); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required><?php echo e($document['fields']['deskripsi']['stringValue']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="berat">Berat</label>
                <input type="text" class="form-control" id="berat" name="berat" value="<?php echo e($document['fields']['berat']['stringValue']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tinggi">Tinggi</label>
                <input type="text" class="form-control" id="tinggi" name="tinggi" value="<?php echo e($document['fields']['tinggi']['stringValue']); ?>" required>
            </div>
            <div class="form-group">
                <label for="lingkar_kepala">Lingkar Kepala</label>
                <input type="text" class="form-control" id="lingkar_kepala" name="lingkar_kepala" value="<?php echo e($document['fields']['lingkar_kepala']['stringValue']); ?>" required>
            </div>
            <div class="form-group">
                <label for="vaksin_info">Informasi Vaksin</label>
                <input type="text" class="form-control" id="vaksin_info" name="vaksin_info" value="<?php echo e($document['fields']['vaksin_info']['stringValue'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="mom_notes">Catatan Ibu</label>
                <textarea class="form-control" id="mom_notes" name="mom_notes[]" rows="3"><?php echo e(implode("\n", array_column($document['fields']['mom_notes']['arrayValue']['values'] ?? [], 'stringValue'))); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Data</button>
        </form>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel-admin-project\resources\views/perkembangan/edit.blade.php ENDPATH**/ ?>