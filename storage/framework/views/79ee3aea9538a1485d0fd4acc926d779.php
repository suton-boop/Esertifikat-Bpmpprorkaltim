
<?php $__env->startSection('title','Kelola User'); ?>

<?php $__env->startSection('content'); ?>
<h4 class="mb-3">Kelola User</h4>

<?php if(session('success')): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<?php if(session('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <?php echo e(session('error')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
  <div class="card-header bg-white d-flex justify-content-between align-items-center">
    <span class="fw-semibold">Daftar User</span>
    <a href="<?php echo e(route('admin.system.users.create')); ?>" class="btn btn-primary btn-sm rounded-3">
      + Tambah User
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th width="5%">#</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th width="18%">Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td class="fw-semibold"><?php echo e($u->name); ?></td>
            <td><?php echo e($u->email); ?></td>
            <td>
              <span class="badge bg-secondary"><?php echo e($u->role?->name ?? '-'); ?></span>
            </td>
            <td>
              <a href="<?php echo e(route('admin.system.users.edit', $u->id)); ?>" class="btn btn-warning btn-sm rounded-3">
                Edit
              </a>

              <form action="<?php echo e(route('admin.system.users.destroy', $u->id)); ?>"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Yakin hapus user ini?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-danger btn-sm rounded-3">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="5" class="text-center text-muted py-4">Belum ada user</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/admin/users/index.blade.php ENDPATH**/ ?>