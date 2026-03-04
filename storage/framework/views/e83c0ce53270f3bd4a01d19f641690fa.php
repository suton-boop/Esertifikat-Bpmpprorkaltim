

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <div>
    <h4 class="mb-0">Template Sertifikat</h4>
    <div class="text-muted">Kelola banyak template, aktifkan/nonaktifkan, dan atur setting.</div>
  </div>

  <a href="<?php echo e(route('admin.system.templates.create')); ?>" class="btn btn-primary rounded-3">
    <i class="fa-solid fa-plus me-1"></i> Tambah Template
  </a>
</div>

<?php if(session('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<?php if(session('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo e(session('error')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<div class="card shadow-sm rounded-4">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th style="width:60px">#</th>
            <th>Nama</th>
            <th style="width:180px">Kode</th>
            <th style="width:160px">Status</th>
            <th style="width:240px" class="text-end">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($loop->iteration); ?></td>

              <td class="fw-semibold"><?php echo e($t->name); ?></td>

              <td>
                <span class="badge text-bg-light border"><?php echo e($t->code); ?></span>
              </td>

              <td>
                <span class="badge <?php echo e($t->is_active ? 'text-bg-success' : 'text-bg-secondary'); ?>">
                  <?php echo e($t->is_active ? 'Active' : 'Inactive'); ?>

                </span>
              </td>

              <td class="text-end">
                <div class="d-inline-flex gap-2">

                  
                  <a href="<?php echo e(route('admin.system.templates.show', $t)); ?>"
                     class="btn btn-info btn-sm rounded-3 text-white"
                     title="Lihat Detail">
                    <i class="fa-solid fa-eye"></i>
                  </a>

                  
                  <a href="<?php echo e(route('admin.system.templates.edit', $t)); ?>"
                     class="btn btn-warning btn-sm rounded-3"
                     title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>

                  
                  <form method="POST" action="<?php echo e(route('admin.system.templates.toggle', $t)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit"
                            class="btn btn-outline-primary btn-sm rounded-3"
                            title="Toggle aktif">
                      <i class="fa-solid fa-power-off"></i>
                    </button>
                  </form>

                  
                  <form method="POST"
                        action="<?php echo e(route('admin.system.templates.destroy', $t)); ?>"
                        class="d-inline"
                        onsubmit="return confirm('Hapus template ini?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>

                    <button type="submit"
                            class="btn btn-outline-danger btn-sm rounded-3"
                            title="Hapus">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>

                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="5" class="text-center text-muted py-4">
                Belum ada template.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<?php if(method_exists($templates, 'links')): ?>
  <div class="mt-3">
    <?php echo e($templates->links()); ?>

  </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/templates/index.blade.php ENDPATH**/ ?>