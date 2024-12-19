<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="baby-carriage-solid.svg" type="x-icon">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Funnel Display', sans-serif;
            background-color: #f8f9fa; 
        }
        .navbar {
            background-color: #d5006d; 
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; 
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ffcccb !important; 
        }
        .container {
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #d5006d; 
            color: #ffffff; 
        }
        .btn-custom:hover {
            background-color: #ffcccb; 
            color: #d5006d; 
        }
        h2 {
            color: #d5006d; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('perkembangan.create')); ?>">   Edit Data Perkembangan Anak   </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="mt-5 text-center"><i class="fas fa-tachometer-alt" style="color: #d5006d;"></i> Dashboard</h2>
        <p class="text-center">Monitoring Dashboard for Admin.</p>

        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Cari berdasarkan email...">
            <select id="sort" class="form-control mt-2">
                <option value="">Urutkan berdasarkan</option>
                <option value="email">Email</option>
                <option value="istri">Nama Istri</option>
                <option value="suami">Nama Suami</option>
                <option value="no_telepon">No. Telepon</option>
            </select>
        </div>

        <table class="table table-bordered mt-3" id="userTable">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nama Istri</th>
                    <th>Nama Suami</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($users ) && count($users) > 0): ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user['fields']['email']['stringValue']); ?></td>
                            <td><?php echo e($user['fields']['istri']['stringValue'] ?? 'N/A'); ?></td>
                            <td><?php echo e($user['fields']['suami']['stringValue'] ?? 'N/A'); ?></td>
                            <td><?php echo e($user['fields']['No. Telepon']['stringValue'] ?? 'N/A'); ?></td>
                            <td>
                                <ul>
                                    <a href="<?php echo e(route('detail', ['email' => $user['fields']['email']['stringValue']])); ?>" class="btn btn-info"><i class="fas fa-child"></i> Lihat Detail</a>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data pengguna.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="<?php echo e(route('perkembangan.create')); ?>" class="btn btn-custom mt-3"><i class="fas fa-plus"></i> Tambah Perkembangan</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#userTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $('#sort').on('change', function() {
                var sortValue = $(this).val();
                var rows = $('#userTable tbody tr').get();
                rows.sort(function(a, b) {
                    var A = $(a).children('td').eq(sortValue === 'email' ? 0 : sortValue === 'istri' ? 1 : sortValue === 'suami' ? 2 : 3).text();
                    var B = $(b).children('td').eq(sortValue === 'email' ? 0 : sortValue === 'istri' ? 1 : sortValue === 'suami' ? 2 : 3).text();
                    return (A < B) ? -1 : (A > B) ? 1 : 0;
                });
                $.each(rows, function(index, row) {
                    $('#userTable tbody').append(row);
                });
            });
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel-admin-project\resources\views/dashboard.blade.php ENDPATH**/ ?>