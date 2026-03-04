
<?php $__env->startSection('title','Tambah Peserta'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h4 class="mb-0">Tambah Peserta</h4>
    <div class="text-muted">Tambahkan peserta ke event.</div>
  </div>
  <a href="<?php echo e(route('admin.participants.index', ['event_id' => request('event_id')])); ?>"
     class="btn btn-outline-secondary rounded-3">
    Kembali
  </a>
</div>

<?php if($errors->any()): ?>
  <div class="alert alert-danger">
    <div class="fw-semibold mb-1">Periksa input:</div>
    <ul class="mb-0">
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.participants.store')); ?>" class="card border-0 shadow-sm rounded-4">
  <?php echo csrf_field(); ?>
  <div class="card-body">
    <div class="row g-3">

      <div class="col-md-6">
        <label class="form-label">Event</label>
        <select name="event_id" class="form-select" required>
          <option value="">-- Pilih Event --</option>
          <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($ev->id); ?>" <?php if(old('event_id', $eventId) == $ev->id): echo 'selected'; endif; ?>>
              <?php echo e($ev->name); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
          <option value="draft"  <?php if(old('status','draft')==='draft'): echo 'selected'; endif; ?>>Draft</option>
          <option value="terbit" <?php if(old('status')==='terbit'): echo 'selected'; endif; ?>>Terbit</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Email (opsional)</label>
        <input name="email" type="email" class="form-control" value="<?php echo e(old('email')); ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">NIK (opsional)</label>
        <input name="nik" class="form-control" value="<?php echo e(old('nik')); ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">Instansi (opsional)</label>
        <input name="institution" class="form-control" value="<?php echo e(old('institution')); ?>">
      </div>

    </div>
  </div>

  <div class="card-footer bg-white d-flex justify-content-end">
    <button class="btn btn-primary rounded-3">
      <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
    </button>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/participants/create.blade.php ENDPATH**/ ?>