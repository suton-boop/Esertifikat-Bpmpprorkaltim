
<?php $__env->startSection('title','Kelola Permission'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
  <div>
    <h4 class="mb-0 fw-bold"><i class="fa-solid fa-key me-2 text-primary"></i>Kelola Permission</h4>
    <div class="text-muted mt-1">Daftar hak akses sistem (dikelompokkan per modul fungsionalitas).</div>
  </div>

  <span class="badge bg-primary fs-6 px-3 py-2 shadow-sm rounded-pill">
    Total: <?php echo e($permissions->count()); ?> Permission
  </span>
</div>

<?php
  // helper label friendly
  $labels = [
    'dashboard-read'      => 'Lihat Dashboard',

    'event-manage'        => 'Kelola Event',
    'participant-manage'  => 'Kelola Peserta',
    'template-manage'     => 'Kelola Template Sertifikat',

    'certificate-generate'=> 'Generate Sertifikat',
    'certificate-send'    => 'Kirim Sertifikat via Email',
    'certificate-approve' => 'Persetujuan Sertifikat',

    'tte-manage'          => 'Kelola TTE (Tanda Tangan Elektronik)',
    'monitoring-read'     => 'Lihat Monitoring',
    'audit-read'          => 'Lihat Audit Trail',

    'user-manage'         => 'Kelola User',
    'role-manage'         => 'Kelola Role',
    'permission-manage'   => 'Kelola Permission',
  ];

  // mapping group berdasarkan prefix/kategori
  $groups = [
    'Dashboard' => ['dashboard-read'],
    'Event & Peserta' => ['event-manage','participant-manage'],
    'Sertifikat' => ['template-manage','certificate-generate','certificate-send','certificate-approve'],
    'TTE & Monitoring' => ['tte-manage','monitoring-read','audit-read'],
    'Manajemen Sistem' => ['user-manage','role-manage','permission-manage'],
  ];

  // buat lookup cepat: name => Permission model
  $permMap = $permissions->keyBy('name');
?>

<div class="row g-4">
  <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $permNames): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 col-xl-6">
      <div class="card border-0 shadow-sm rounded-4 h-100 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'">
        <div class="card-header border-bottom-0 bg-transparent pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
          <div class="d-inline-flex align-items-center px-3 py-2 bg-primary bg-opacity-10 text-primary rounded-3 shadow-sm" style="border-left: 4px solid #0d6efd;">
             <h6 class="fw-bold mb-0" style="letter-spacing: 0.3px;"><?php echo e($groupName); ?></h6>
          </div>
          <span class="badge bg-light text-dark border rounded-pill px-3">
            <?php echo e(collect($permNames)->filter(fn($n)=>$permMap->has($n))->count()); ?>

          </span>
        </div>

        <div class="card-body px-4 pb-4">
          <div class="row g-3">
            <?php $__currentLoopData = $permNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $p = $permMap->get($name);
              ?>

              <?php if($p): ?>
                <div class="col-12 col-md-6">
                  <div class="border rounded-3 p-3 bg-light h-100 d-flex align-items-center p-2" style="border-color: #f1f5f9 !important;">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0 me-3" style="width: 40px; height: 40px;">
                      <i class="fa-solid fa-check text-success"></i>
                    </div>
                    <div>
                      <div class="fw-bold text-dark fs-6"><?php echo e($labels[$name] ?? $name); ?></div>
                      <div class="text-muted small font-monospace"><?php echo e($name); ?></div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<?php
  $known = collect($groups)->flatten()->unique();
  $unknown = $permissions->filter(fn($p)=> !$known->contains($p->name));
?>

<?php if($unknown->count()): ?>
  <div class="card border-0 shadow-sm rounded-4 mt-4 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'">
    <div class="card-header border-bottom-0 bg-transparent pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
      <div class="d-inline-flex align-items-center px-3 py-2 bg-secondary bg-opacity-10 text-secondary rounded-3 shadow-sm" style="border-left: 4px solid #6c757d;">
        <h6 class="fw-bold mb-0" style="letter-spacing: 0.3px;"><i class="fa-solid fa-boxes-stacked me-2"></i>Lainnya (Uncategorized)</h6>
      </div>
      <span class="badge bg-secondary rounded-pill px-3"><?php echo e($unknown->count()); ?></span>
    </div>
    
    <div class="card-body px-4 pb-4">
      <div class="row g-3">
        <?php $__currentLoopData = $unknown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="border rounded-3 p-3 bg-light h-100 d-flex align-items-center" style="border-color: #f8f9fa !important;">
                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0 me-3 opacity-50" style="width: 40px; height: 40px;">
                      <i class="fa-solid fa-tag text-secondary"></i>
                </div>
                <div>
                  <div class="fw-bold text-dark"><?php echo e($p->name); ?></div>
                  <div class="text-muted" style="font-size:12px;">Permission belum dikelompokkan</div>
                </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/admin/permissions/index.blade.php ENDPATH**/ ?>