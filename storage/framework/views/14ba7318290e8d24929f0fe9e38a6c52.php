<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
</head>
<body>
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
                <?php if(isset($users) && count($users) > 0): ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user['fields']['email']['stringValue']); ?></td>
                            <td><?php echo e($user['fields']['istri']['stringValue'] ?? 'N/A'); ?></td>
                            <td><?php echo e($user['fields']['suami']['stringValue'] ?? 'N/A'); ?></td>
                            <td><?php echo e($user['fields']['No. Telepon']['stringValue'] ?? 'N/A'); ?></td>
                            <td>
                                <a href="<?php echo e(route('children', ['email' => $user['fields']['email']['stringValue']])); ?>" class="btn btn-info"><i class="fas fa-child"></i> Lihat Data Anak</a>
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

        <a href="<?php echo e(url('/logout')); ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
</html><?php /**PATH C:\xampp\htdocs\laravel-login-project\resources\views/dashboard.blade.php ENDPATH**/ ?>