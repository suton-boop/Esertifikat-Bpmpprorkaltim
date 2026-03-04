
<?php $__env->startSection('title','Laporan Sertifikat'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
  <div>
    <h4 class="mb-0">Laporan & Statistik</h4>
    <div class="text-muted">Ringkasan penerbitan E-Sertifikat per kegiatan.</div>
  </div>
  
  <form method="GET" action="<?php echo e(route('admin.reports')); ?>" class="d-flex gap-2">
    <select name="year" class="form-select border-0 shadow-sm rounded-3 fw-semibold text-primary" onchange="this.form.submit()" style="min-width: 140px; cursor: pointer;">
      <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($y); ?>" <?php if($y == $year): echo 'selected'; endif; ?>>Tahun <?php echo e($y); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </form>
</div>


<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-muted small fw-semibold text-uppercase mb-1">Total Event</div>
            <h3 class="mb-0 fw-bold"><?php echo e(number_format($totalEvents)); ?></h3>
          </div>
          <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px;">
            <i class="fa-solid fa-calendar-days"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-muted small fw-semibold text-uppercase mb-1">Total Peserta</div>
            <h3 class="mb-0 fw-bold text-primary"><?php echo e(number_format($totalParticipants)); ?></h3>
          </div>
          <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px;">
            <i class="fa-solid fa-users"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-muted small fw-semibold text-uppercase mb-1">Draf Baru</div>
            <h3 class="mb-0 fw-bold text-warning"><?php echo e(number_format($totalDraft)); ?></h3>
          </div>
          <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px;">
            <i class="fa-solid fa-file-invoice"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-muted small fw-semibold text-uppercase mb-1">Telah Terbit</div>
            <h3 class="mb-0 fw-bold text-success"><?php echo e(number_format($totalSigned)); ?></h3>
          </div>
          <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px;">
            <i class="fa-solid fa-certificate"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="card border-0 shadow-sm rounded-4">
  <div class="card-header bg-white border-bottom-0 py-3">
    <h6 class="mb-0 mx-2 mt-2 fw-semibold">Rincian Per Event (Tahun <?php echo e($year); ?>)</h6>
  </div>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th width="5%" class="text-center">#</th>
          <th>Nama Event</th>
          <th>Tanggal</th>
          <th class="text-center">Total Peserta</th>
          <th class="text-center">Total Sertifikat</th>
          <th class="text-center">Draft</th>
          <th class="text-center">Waiting Approval</th>
          <th class="text-center">TTE Ready</th>
          <th class="text-center">Final (Terbit)</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td class="text-center text-muted"><?php echo e(($events->currentPage() - 1) * $events->perPage() + $loop->iteration); ?></td>
            <td class="fw-semibold">
                <?php echo e($ev->name); ?>

            </td>
            <td>
                <?php if($ev->start_date): ?>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-regular fa-calendar text-muted"></i>
                        <?php echo e(\Carbon\Carbon::parse($ev->start_date)->translatedFormat('d M Y')); ?>

                    </div>
                <?php else: ?>
                    <span class="text-muted">-</span>
                <?php endif; ?>
            </td>
            <td class="text-center">
                <span class="badge bg-light text-dark border"><?php echo e($ev->participants_count); ?></span>
            </td>
            <td class="text-center">
                <span class="badge bg-secondary"><?php echo e($ev->certificates_count); ?></span>
            </td>
            
            <td class="text-center">
                <?php if($ev->cert_draft > 0): ?>
                    <span class="badge bg-warning text-dark"><?php echo e($ev->cert_draft); ?></span>
                <?php else: ?> <span class="text-muted small">-</span> <?php endif; ?>
            </td>
            <td class="text-center">
                <?php if($ev->cert_submitted > 0): ?>
                    <span class="badge bg-info text-dark"><?php echo e($ev->cert_submitted); ?></span>
                <?php else: ?> <span class="text-muted small">-</span> <?php endif; ?>
            </td>
            <td class="text-center">
                <?php if($ev->cert_approved > 0): ?>
                    <span class="badge bg-primary"><?php echo e($ev->cert_approved); ?></span>
                <?php else: ?> <span class="text-muted small">-</span> <?php endif; ?>
            </td>
            <td class="text-center">
                <?php if($ev->cert_signed > 0): ?>
                    <span class="badge bg-success shadow-sm px-2 py-1"><i class="fa-solid fa-check me-1"></i> <?php echo e($ev->cert_signed); ?></span>
                <?php else: ?> <span class="text-muted small">-</span> <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="9" class="text-center py-5 text-muted">
                <div class="fs-1 text-light mb-3"><i class="fa-solid fa-folder-open"></i></div>
                Belum ada data event / sertifikat di tahun ini.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  
  <?php if($events->hasPages()): ?>
    <div class="card-footer bg-white border-0 py-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="text-muted small ps-2">
                Menampilkan <strong><?php echo e($events->firstItem()); ?></strong> hingga <strong><?php echo e($events->lastItem()); ?></strong> dari total <strong><?php echo e($events->total()); ?></strong> kegiatan
            </div>
            <div class="pe-2"><?php echo e($events->links()); ?></div>
        </div>
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>