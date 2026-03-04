
<?php $__env->startSection('title','Import Peserta'); ?>

<?php $__env->startSection('content'); ?>
<?php
  $events  = $events ?? collect();
  $eventId = $eventId ?? request('event_id');
?>

<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
  <div>
    <h4 class="mb-0">Import Peserta</h4>
    <div class="text-muted">Upload berkas Excel (.xlsx) atau CSV untuk menambahkan peserta per event.</div>
  </div>

  <div class="d-flex gap-2">
    <a href="<?php echo e(route('admin.participants.template')); ?>" class="btn btn-outline-success rounded-3">
    <i class="fa-solid fa-file-excel me-1"></i> Template Excel
    </a>

    <a href="<?php echo e(route('admin.participants.index', ['event_id' => $eventId])); ?>" class="btn btn-outline-secondary rounded-3">
      <i class="fa-solid fa-arrow-left me-1"></i> Kembali
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

<div class="card border-0 shadow-sm rounded-4">
  <div class="card-body">
    <div class="alert alert-info">
      <div class="fw-semibold mb-1">Format Kolom Excel / CSV</div>
      <div class="small">
        Header dari baris pertama harus berisi: <code>name</code> (wajib),
        <code>email</code>, <code>nik</code>, <code>institution</code>, <code>status</code> (draft/terbit).<br>
        Gunakan tombol <b>Template Excel</b> di atas untuk contoh struktur format kolom.
      </div>
    </div>

    <form method="POST" action="<?php echo e(route('admin.participants.import.store')); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Pilih Event <span class="text-danger">*</span></label>
          <select name="event_id" class="form-select <?php $__errorArgs = ['event_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
            <option value="">-- Pilih Event --</option>
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($ev->id); ?>" <?php if((string)old('event_id', $eventId) === (string)$ev->id): echo 'selected'; endif; ?>>
                <?php echo e($ev->name); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php $__errorArgs = ['event_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-6">
          <label class="form-label">File Excel / CSV <span class="text-danger">*</span></label>
          <input type="file"
                 name="file"
                 accept=".xlsx,.xls,.csv,.txt"
                 class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                 required>
          <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          <div class="form-text">Maks 5MB. Gunakan format file .xlsx (Microsoft Excel) atau .csv</div>
        </div>
      </div>

      <hr class="my-4">

      <div class="d-flex justify-content-end gap-2">
        <a href="<?php echo e(route('admin.participants.index', ['event_id' => $eventId])); ?>" class="btn btn-outline-secondary rounded-3">
          Batal
        </a>
        <button class="btn btn-primary rounded-3">
          <i class="fa-solid fa-file-arrow-up me-1"></i> Proses Import
        </button>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/participants/import.blade.php ENDPATH**/ ?>