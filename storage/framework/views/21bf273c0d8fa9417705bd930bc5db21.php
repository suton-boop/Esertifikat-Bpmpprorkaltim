

<?php $__env->startSection('title', 'Cari Sertifikat - BPMP Kaltim'); ?>
<?php $__env->startSection('breadcrumb', 'Pencarian Sertifikat'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <!-- Search Form Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 bg-white" data-aos="fade-up">
            <div class="card-body p-4 p-md-5 text-center">
                <div class="mb-4">
                    <h4 class="fw-bold text-dark mb-2">Cari Data Sertifikat</h4>
                    <p class="text-muted">Masukkan Nama, NIK, Email, atau Unit Kerja untuk menemukan sertifikat Anda.</p>
                </div>
                
                <form action="<?php echo e(route('public.search.process')); ?>" method="POST" class="d-flex justify-content-center">
                    <?php echo csrf_field(); ?>
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden" style="max-width: 700px; border: 1px solid #e2e8f0;">
                        <span class="input-group-text bg-white border-0 ps-4 text-muted">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" name="keyword" class="form-control border-0 py-3" placeholder="Contoh: Budi Santoso" required autofocus value="<?php echo e($keyword ?? old('keyword', request('keyword'))); ?>">
                        <button class="btn btn-primary px-4 fw-bold shadow-none" type="submit">
                            CARI
                        </button>
                    </div>
                </form>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger mt-4 d-inline-block text-start mb-0 rounded-3 border-0 shadow-sm px-4">
                        <i class="fa-solid fa-circle-exclamation me-2"></i> <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if(isset($results)): ?>
            <?php if(count($results) === 0): ?>
                <div class="alert alert-warning text-center p-5 rounded-4 shadow-sm border-0 bg-white" data-aos="zoom-in">
                    <div class="mb-3">
                        <i class="fa-solid fa-face-frown text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Data Tidak Ditemukan</h4>
                    <p class="text-muted mb-4">Maaf, data yang Anda cari tidak ada atau kata kunci yang dimasukkan salah.</p>
                    <a href="<?php echo e(route('public.search')); ?>" class="btn btn-outline-primary fw-bold px-4 rounded-3">
                        <i class="fa-solid fa-rotate-left me-2"></i> Coba Lagi
                    </a>
                </div>
            <?php else: ?>
                <div class="mb-4 d-flex align-items-center justify-content-between" data-aos="fade-up">
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="fa-solid fa-list-check me-2 text-primary"></i> Hasil Pencarian
                    </h5>
                    <span class="badge bg-light text-primary px-3 py-2 rounded-pill fw-bold border border-primary border-opacity-10">
                        <?php echo e(count($results)); ?> Data Ditemukan
                    </span>
                </div>
                
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5" data-aos="fade-up">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%" class="py-3 text-center">No</th>
                                    <th class="py-3">Nama Lengkap</th>
                                    <th class="py-3">Unit Kerja / Instansi</th>
                                    <th class="py-3">Kegiatan</th>
                                    <th width="15%" class="py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover-row">
                                        <td class="text-center fw-bold text-muted"><?php echo e($index + 1); ?></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?php echo e($cert->participant->name); ?></div>
                                            <div class="small text-muted"><?php echo e($cert->participant->email ?? ''); ?></div>
                                        </td>
                                        <td>
                                            <div class="text-dark"><?php echo e($cert->participant->institution ?? '-'); ?></div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark mb-1"><?php echo e($cert->event->name); ?></div>
                                            <div class="small text-muted">
                                                <i class="fa-regular fa-calendar-days me-1"></i>
                                                <?php echo e($cert->event->start_date ? \Carbon\Carbon::parse($cert->event->start_date)->translatedFormat('d M Y') : '-'); ?>

                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php if($cert->pdf_path || $cert->signed_pdf_path): ?>
                                                <a href="<?php echo e(route('public.download', $cert->verify_token)); ?>" target="_blank" class="btn btn-sm btn-success rounded-3 px-3 fw-bold d-inline-flex align-items-center gap-1">
                                                    <i class="fa-solid fa-download"></i> Cetak
                                                </a>
                                            <?php else: ?>
                                                <span class="badge bg-light text-secondary px-3 py-2 rounded-pill fw-medium border border-secondary border-opacity-10">
                                                    <i class="fa-solid fa-spinner fa-spin me-1"></i> Proses TTE
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>

<style>
    .hover-row {
        transition: background-color 0.2s ease;
    }
    .hover-row:hover {
        background-color: #f8fafc;
    }
    .input-group:focus-within {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15) !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/public/search.blade.php ENDPATH**/ ?>