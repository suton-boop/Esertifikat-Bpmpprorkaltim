
<?php $__env->startSection('title','Kelola Role'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0 fw-bold">Kelola Role</h4>
        <small class="text-muted">Daftar role dan jumlah permission.</small>
    </div>
</div>


<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
    <i class="fa-solid fa-circle-check me-1"></i>
    <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center rounded-top-4">
        <span class="fw-semibold">
            <i class="fa-solid fa-user-shield me-1 text-primary"></i>
            Daftar Role
        </span>

        
        
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="5%">#</th>
                    <th>Role</th>
                    <th width="20%">Jumlah Permission</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>

                    <td class="fw-semibold text-dark">
                        <?php echo e($r->name); ?>

                    </td>

                    <td>
                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                            <?php echo e($r->permissions->count()); ?>

                        </span>
                    </td>

                    <td>
                        <a href="<?php echo e(route('admin.system.roles.edit', $r->id)); ?>"
                           class="btn btn-primary btn-sm rounded-3">
                            <i class="fa-solid fa-key me-1"></i> Kelola Permission
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted py-5">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        Belum ada data role
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>