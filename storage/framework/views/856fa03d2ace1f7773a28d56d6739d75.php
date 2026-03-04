
<?php $__env->startSection('title','Sertifikat Terbit'); ?>

<?php $__env->startSection('content'); ?>
<?php
  $events       = $events ?? collect();
  $certificates = $certificates ?? null;

  $q       = $q ?? request('q', '');
  $eventId = $eventId ?? request('event_id', '');
?>

<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
  <div>
    <h4 class="mb-0">Sertifikat Terbit</h4>
    <div class="text-muted">Daftar sertifikat yang telah diterbitkan atau ditandatangani secara elektronik (TTE).</div>
  </div>
</div>

<form method="GET" action="<?php echo e(route('admin.certificates.published')); ?>"
      class="card border-0 shadow-sm rounded-4 mb-3">
  <div class="card-body">
    <div class="row g-2 align-items-end">
      <div class="col-lg-6">
        <label class="form-label small text-muted mb-1">Cari</label>
        <input type="text" name="q" class="form-control" value="<?php echo e($q); ?>"
               placeholder="Cari nama / nomor referensi / NIK...">
      </div>

      <div class="col-lg-5">
        <label class="form-label small text-muted mb-1">Event</label>
        <select name="event_id" class="form-select">
          <option value="">-- Semua Event --</option>
          <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($ev->id); ?>" <?php if((string)$eventId === (string)$ev->id): echo 'selected'; endif; ?>>
              <?php echo e($ev->name); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="col-lg-1 d-flex gap-2">
        <button class="btn btn-primary w-100" title="Cari">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <a class="btn btn-outline-secondary" href="<?php echo e(route('admin.certificates.published')); ?>" title="Reset">
          <i class="fa-solid fa-rotate-left"></i>
        </a>
      </div>
    </div>
  </div>
</form>

<div class="card border-0 shadow-sm rounded-4">
  <div class="card-header bg-white border-0 d-flex flex-wrap justify-content-between align-items-center gap-2">
    <div>
      <div class="fw-semibold">Daftar Sertifikat Terbit</div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="text-muted small">Total: <?php echo e($certificates?->total() ?? 0); ?></div>
        <a href="<?php echo e(route('admin.certificates.published.export', request()->query())); ?>" class="btn btn-sm btn-success text-white fw-medium">
            <i class="fa-solid fa-file-excel me-1"></i> Eksport ke Excel
        </a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th width="5%">#</th>
          <th>Nama Peserta</th>
          <th>Nomor Sertifikat</th>
          <th>Event</th>
          <th>Status</th>
          <th width="15%" class="text-end">Aksi</th>
        </tr>
      </thead>

      <tbody>
      <?php if(!$certificates || $certificates->isEmpty()): ?>
        <tr>
          <td colspan="6" class="text-center text-muted py-4">Belum ada sertifikat terbit.</td>
        </tr>
      <?php else: ?>
        <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e(($certificates->currentPage()-1)*$certificates->perPage() + $loop->iteration); ?></td>

            <td class="fw-semibold">
              <?php echo e($cert->participant->name ?? '-'); ?>

              <?php if($cert->participant->institution): ?>
                <div class="text-muted small"><?php echo e($cert->participant->institution); ?></div>
              <?php endif; ?>
            </td>

            <td>
              <span class="fw-semibold text-primary"><?php echo e($cert->certificate_number ?? '-'); ?></span>
            </td>

            <td><?php echo e($cert->event?->name ?? '-'); ?></td>

            <td>
              <span class="badge bg-success"><i class="fa-solid fa-check-circle me-1"></i> Terbit</span>
            </td>

            <td class="text-end">
              <div class="d-inline-flex gap-2">

                <?php
                  $hasPdf = !empty($cert->signed_pdf_path) || !empty($cert->pdf_path);
                ?>

                <?php if($hasPdf): ?>
                  
                  <a class="btn btn-outline-success btn-sm rounded-3"
                     href="<?php echo e(route('admin.certificates.view', $cert->id)); ?>"
                     target="_blank"
                     title="Preview PDF Final">
                    <i class="fa-solid fa-eye"></i>
                  </a>

                  
                  <a class="btn btn-outline-primary btn-sm rounded-3"
                     href="<?php echo e(route('admin.certificates.download', $cert->id)); ?>"
                     title="Download PDF">
                    <i class="fa-solid fa-download"></i>
                  </a>
                <?php else: ?>
                  <button class="btn btn-outline-secondary btn-sm rounded-3" disabled title="PDF belum ada">
                    <i class="fa-solid fa-eye"></i>
                  </button>
                  <button class="btn btn-outline-secondary btn-sm rounded-3" disabled title="PDF belum ada">
                    <i class="fa-solid fa-download"></i>
                  </button>
                <?php endif; ?>

              </div>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if($certificates && $certificates->hasPages()): ?>
    <div class="card-footer bg-white border-0 d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div class="text-muted small">
        Menampilkan <?php echo e($certificates->firstItem()); ?> - <?php echo e($certificates->lastItem()); ?>

        dari <?php echo e($certificates->total()); ?> data
      </div>
      <div><?php echo e($certificates->links()); ?></div>
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/certificates/published.blade.php ENDPATH**/ ?>