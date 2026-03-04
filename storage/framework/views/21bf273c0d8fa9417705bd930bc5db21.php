

<?php $__env->startSection('title', 'Cari Sertifikat - BPMP Kaltim'); ?>
<?php $__env->startSection('breadcrumb', 'Pencarian Sertifikat'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-10">
        
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
            <div class="card-header border-0 py-3" style="background-color: transparent; border-bottom: 2px solid #f1f5f9 !important;">
                <h6 class="mb-0 fw-bold text-center text-dark">Form untuk mencari data Sertifikat E-Sertifikat</h6>
            </div>
            <div class="card-body p-4 text-center">
                <h5 class="fw-bold mb-4 text-dark">Ketik Nama atau NIK atau Email atau Unit Kerja kemudian tekan tombol Cari</h5>
                
                <form action="<?php echo e(route('public.search.process')); ?>" method="POST" class="d-flex justify-content-center">
                    <?php echo csrf_field(); ?>
                    <div class="input-group input-group-lg shadow-sm" style="max-width: 650px;">
                        <input type="text" name="keyword" class="form-control" style="border: 2px solid #e1e8ed;" placeholder="Tulis disini........" required autofocus value="<?php echo e($keyword ?? old('keyword', request('keyword'))); ?>">
                        <button class="btn fw-semibold px-4 text-white" type="submit" style="background-color: #f0ad4e; border-color: #eea236; letter-spacing: 1px;">
                            <i class="fa-solid fa-search me-1"></i> CARI
                        </button>
                    </div>
                </form>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger mt-4 d-inline-block text-start mb-0">
                        <i class="fa-solid fa-circle-exclamation me-2"></i> <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if(isset($results)): ?>
            <?php if(count($results) === 0): ?>
                <div class="alert alert-danger text-center p-4 rounded-3 shadow-sm border-0" style="background-color: #f8dede; color: #a94442;">
                    <button type="button" class="btn-close float-end" onclick="this.parentElement.style.display='none'"></button>
                    <h5 class="fw-normal mb-2 fs-4">Peringatan !</h5>
                    <p class="mb-3">Data yang anda cari tidak ada atau keywordnya salah</p>
                    <a href="<?php echo e(route('public.search')); ?>" class="btn btn-warning btn-sm text-white fw-bold px-3 rounded-2 shadow-sm" style="background-color: #f0ad4e; border-color: #eea236;">
                        <i class="fa-solid fa-rotate-left me-1"></i> Kembali
                    </a>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden mt-4">
                    <div class="card-header border-0 py-2" style="background-color: #dff0d8; color: #3c763d;">
                        <h6 class="mb-0 fw-semibold">Hasil Pencarian</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-bordered border-white">
                            <thead class="text-dark fw-bold" style="background-color: #c4e300;">
                                <tr>
                                    <th width="5%" class="py-3 text-center border-0">No</th>
                                    <th class="py-3 border-0">Nama</th>
                                    <th class="py-3 border-0">Unit Kerja</th>
                                    <th class="py-3 border-0">Kegiatan</th>
                                    <th width="15%" class="py-3 text-center border-0">Unduh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-white">
                                        <td class="text-center fw-bold text-dark border-bottom"><?php echo e($index + 1); ?></td>
                                        <td class="fw-semibold text-dark border-bottom"><?php echo e($cert->participant->name); ?></td>
                                        <td class="text-dark border-bottom"><?php echo e($cert->participant->institution ?? '-'); ?></td>
                                        <td class="text-dark border-bottom">
                                            <?php echo e($cert->event->name); ?><br>
                                            <span style="font-size: 13px;" class="text-secondary">
                                                <?php echo e($cert->event->start_date ? \Carbon\Carbon::parse($cert->event->start_date)->translatedFormat('d M Y') : ''); ?>

                                            </span>
                                        </td>
                                        <td class="text-center border-bottom">
                                            <?php if($cert->pdf_path || $cert->signed_pdf_path): ?>
                                                <a href="<?php echo e(route('public.download', $cert->verify_token)); ?>" target="_blank" class="btn btn-success btn-sm rounded-1 shadow-sm fw-semibold" style="background-color: #5cb85c; border-color: #4cae4c; font-size: 13px;">
                                                    <i class="fa-solid fa-circle-down me-1"></i> CETAK SERTIFIKAT
                                                </a>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Proses TTE</span>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/public/search.blade.php ENDPATH**/ ?>