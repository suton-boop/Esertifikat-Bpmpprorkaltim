
<?php $__env->startSection('title', 'Distribusi Email'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0 fw-bold"><i class="fa-solid fa-paper-plane me-2 text-primary"></i>Distribusi Email</h4>
        <div class="text-muted mt-1">Kirim sertifikat yang telah diterbitkan (TTE) ke email peserta.</div>
    </div>
</div>


<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check me-1"></i> <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="fw-bold"><i class="fa-solid fa-triangle-exclamation me-1"></i> Gagal Mengirim Email</div>
    <ul class="mb-0 mt-2">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($err); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white py-3">
        <form method="GET" action="<?php echo e(route('admin.emails.index')); ?>" class="row g-2 align-items-center">
            
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari nama / email peserta..." value="<?php echo e(request('search')); ?>">
                </div>
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status Siap Kirim</option>
                    <option value="signed" <?php if(request('status') === 'signed'): echo 'selected'; endif; ?>>TTE Selesai (signed)</option>
                    <option value="terbit" <?php if(request('status') === 'terbit'): echo 'selected'; endif; ?>>Telah Terbit</option>
                    <option value="sent" <?php if(request('status') === 'sent'): echo 'selected'; endif; ?>>Sudah Dikirim (sent)</option>
                </select>
            </div>

            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-3 text-nowrap"><i class="fa-solid fa-filter me-1"></i> Filter</button>
                <?php if(request()->hasAny(['search', 'status'])): ?>
                    <a href="<?php echo e(route('admin.emails.index')); ?>" class="btn btn-light border text-nowrap">Reset</a>
                <?php endif; ?>
            </div>

        </form>
    </div>

    <div class="card-body p-0 table-responsive border-top">
        <form id="formSendEmail" method="POST" action="<?php echo e(route('admin.emails.send')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="px-4 py-3 bg-light d-flex justify-content-between align-items-center">
                <span class="text-secondary fw-semibold">
                    <span id="selectedCount">0</span> Sertifikat dipilih
                </span>
                <button type="button" class="btn btn-success" onclick="confirmSendEmail()" id="btnSend" disabled>
                    <i class="fa-solid fa-paper-plane me-1"></i> Kirim Email Terpilih
                </button>
            </div>

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="40" class="text-center ps-4">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                        </th>
                        <th>Peserta</th>
                        <th>Program / Event</th>
                        <th>Sertifikat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center ps-4">
                            <input class="form-check-input row-checkbox" type="checkbox" name="certificate_ids[]" value="<?php echo e($cert->id); ?>">
                        </td>
                        <td>
                            <div class="fw-bold"><?php echo e($cert->participant->name ?? '-'); ?></div>
                            <div class="small text-muted"><i class="fa-regular fa-envelope me-1"></i><?php echo e($cert->participant->email ?? 'Tidak ada email'); ?></div>
                        </td>
                        <td>
                            <div class="fw-semibold text-truncate" style="max-width:250px;" title="<?php echo e($cert->event->name ?? '-'); ?>"><?php echo e($cert->event->name ?? '-'); ?></div>
                        </td>
                        <td>
                            <div class="font-monospace small bg-light p-1 rounded d-inline-block"><?php echo e($cert->certificate_number ?? '-'); ?></div>
                        </td>
                        <td>
                            <?php if($cert->status === \App\Models\Certificate::STATUS_SENT): ?>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">
                                    <i class="fa-solid fa-check-double me-1"></i>Terkirim
                                </span>
                                <?php if($cert->sent_at): ?>
                                    <div class="small text-muted mt-1" style="font-size:11px;"><?php echo e($cert->sent_at->format('d M Y, H:i')); ?></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">
                                    <i class="fa-solid fa-envelope-circle-check me-1"></i>Siap Kirim
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted"><i class="fa-regular fa-folder-open fs-2 mb-2"></i><br>Tidak ada sertifikat siap kirim yang ditemukan.</div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
    </div>
    
    <?php if($certificates->hasPages()): ?>
    <div class="card-footer bg-white py-3">
        <?php echo e($certificates->links()); ?>

    </div>
    <?php endif; ?>
</div>

<script>
    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const btnSend = document.getElementById('btnSend');

    function updateSelection() {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const count = checkedBoxes.length;
        selectedCount.textContent = count;
        
        btnSend.disabled = count === 0;
        checkAll.checked = (count === checkboxes.length && checkboxes.length > 0);
    }

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            updateSelection();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateSelection);
    });

    function confirmSendEmail() {
        const count = document.querySelectorAll('.row-checkbox:checked').length;
        if(count === 0) return;
        
        if(confirm(`Anda yakin ingin mengirim / mensimulasikan pengiriman email ke ${count} peserta terpilih?`)) {
            document.getElementById('formSendEmail').submit();
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/emails/index.blade.php ENDPATH**/ ?>