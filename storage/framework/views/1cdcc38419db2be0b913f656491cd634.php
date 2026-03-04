
<?php $__env->startSection('title','Kelola Peserta'); ?>

<?php $__env->startSection('content'); ?>
<?php
  /** @var \Illuminate\Pagination\LengthAwarePaginator $participants */
  $events  = $events ?? collect();

  $q       = $q ?? request('q', '');
  $eventId = $eventId ?? request('event_id', '');
  $status  = $status ?? request('status', '');
?>

<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
  <div>
    <h4 class="mb-0">Kelola Peserta</h4>
    <div class="text-muted">Kelola peserta berdasarkan event.</div>
  </div>
  

  <div class="d-flex flex-wrap gap-2">
    <a href="<?php echo e(route('admin.participants.import.form', ['event_id' => $eventId])); ?>"
       class="btn btn-outline-primary rounded-3">
      <i class="fa-solid fa-file-import me-1"></i> Import
    </a>

    <a href="<?php echo e(route('admin.participants.create', ['event_id' => $eventId])); ?>"
       class="btn btn-primary rounded-3">
      <i class="fa-solid fa-plus me-1"></i> Tambah Peserta
    </a>
  </div>
</div>

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


<form method="GET" action="<?php echo e(route('admin.participants.index')); ?>" class="card border-0 shadow-sm rounded-4 mb-3">
  <div class="card-body">
    <div class="row g-2 align-items-end">

      <div class="col-lg-5">
        <label class="form-label small text-muted mb-1">Cari</label>
        <input type="text"
               name="q"
               class="form-control"
               value="<?php echo e($q); ?>"
               placeholder="Cari nama / email / NIK / instansi...">
      </div>

      <div class="col-lg-4">
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

      <div class="col-lg-2">
        <label class="form-label small text-muted mb-1">Status</label>
        <select name="status" class="form-select">
          <option value="">-- Semua --</option>
          <option value="draft"  <?php if($status === 'draft'): echo 'selected'; endif; ?>>Draft</option>
          <option value="terbit" <?php if($status === 'terbit'): echo 'selected'; endif; ?>>Terbit</option>
        </select>
      </div>

      <div class="col-lg-1 d-flex gap-2">
        <button class="btn btn-primary w-100" title="Cari">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <a class="btn btn-outline-secondary" href="<?php echo e(route('admin.participants.index')); ?>" title="Reset">
          <i class="fa-solid fa-rotate-left"></i>
        </a>
      </div>

    </div>
  </div>
</form>


<div class="card border-0 shadow-sm rounded-4">
  <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
    <div class="fw-semibold">Daftar Peserta</div>
    <div class="text-muted small">
      Total: <?php echo e($participants->total()); ?>

    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th width="5%">#</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Event</th>
          <th>Status</th>
          <th width="12%">Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><?php echo e(($participants->currentPage()-1)*$participants->perPage() + $loop->iteration); ?></td>

            <td class="fw-semibold">
              <?php echo e($p->name); ?>

              <div class="text-muted small">
                <?php echo e($p->institution ?? ''); ?>

                <?php if($p->jenjang): ?> - <?php echo e($p->jenjang); ?> <?php endif; ?>
                <?php if($p->daerah): ?> (<?php echo e($p->daerah); ?>) <?php endif; ?>
              </div>
              <?php if($p->peran): ?>
                <span class="badge bg-light text-dark border small mt-1"><?php echo e($p->peran); ?></span>
              <?php endif; ?>
            </td>

            <td><?php echo e($p->email ?? '-'); ?></td>

            <td class="text-truncate" style="max-width: 320px;">
              <?php echo e($p->event?->name ?? '-'); ?>

            </td>

            <td>
              <?php
              $label = $p->cert_status ?? $p->status ?? 'draft';

              $badgeMap = [
                'draft' => 'bg-secondary',
                'pending' => 'bg-warning',
                'submitted' => 'bg-warning',
                'approved' => 'bg-primary',
                'rejected' => 'bg-danger',
                'final_generated' => 'bg-info',
                'signed' => 'bg-success',
              ];

              $badge = $badgeMap[$label] ?? 'bg-secondary';
            ?>

              <span class="badge <?php echo e($badge); ?>"><?php echo e(strtoupper($label)); ?></span>
            </td>

            <td class="d-flex gap-2">
              <a href="<?php echo e(route('admin.participants.edit', $p->id)); ?>"
                 class="btn btn-warning btn-sm rounded-3"
                 title="Edit">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>

              <form action="<?php echo e(route('admin.participants.destroy', $p->id)); ?>"
                    method="POST"
                    onsubmit="return confirm('Yakin hapus peserta ini?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-danger btn-sm rounded-3" title="Hapus">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="6" class="text-center text-muted py-4">Belum ada peserta.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>


<?php if($participants && $participants->hasPages()): ?>
  <div class="card-footer bg-white border-0">
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">

      <div class="text-muted small">
        Showing <strong><?php echo e($participants->firstItem()); ?></strong>
        to <strong><?php echo e($participants->lastItem()); ?></strong>
        of <strong><?php echo e($participants->total()); ?></strong> entries
      </div>

      <div class="d-flex justify-content-end">
        <?php echo e($participants->onEachSide(1)->links()); ?>

      </div>

    </div>
  </div>
<?php endif; ?>

</div>
<?php $__env->stopSection(); ?>


=
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/participants/index.blade.php ENDPATH**/ ?>