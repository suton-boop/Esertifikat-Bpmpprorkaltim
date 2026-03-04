
<?php $__env->startSection('title','Kelola Permission Role'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <div>
        <h4 class="mb-0 fw-bold"><i class="fa-solid fa-user-shield me-2 text-primary"></i>Kelola Permission Role</h4>
        <div class="text-muted mt-1">
            Mengatur hak akses sistem untuk role: <span class="badge bg-primary fs-6"><?php echo e(Str::title($role->name)); ?></span>
        </div>
    </div>

    <a href="<?php echo e(route('admin.system.roles.index')); ?>" class="btn btn-light border-secondary shadow-sm rounded-3 fw-semibold">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>


<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <div class="fw-semibold mb-1">Terjadi kesalahan:</div>
    <ul class="mb-0">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?php echo e(route('admin.system.roles.update', $role->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar Permission</span>

            <span class="badge bg-primary">
                Total: <?php echo e($permissions->count()); ?>

            </span>
        </div>

        <div class="card-body p-4 bg-light">
            <div class="row g-3">

                
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-lg-3">
                    <label class="card border-0 shadow-sm h-100 d-flex flex-row align-items-center p-3" style="cursor: pointer; transition: all 0.2s ease-in-out;" onmouseover="this.classList.add('shadow'); this.style.transform='translateY(-2px)'" onmouseout="this.classList.remove('shadow'); this.style.transform='none'">
                        <div class="form-check form-switch mb-0 d-flex align-items-center ps-0 w-100">
                            <input class="form-check-input m-0 me-3 shadow-none flex-shrink-0"
                                   type="checkbox"
                                   role="switch"
                                   name="permissions[]"
                                   value="<?php echo e($p->id); ?>"
                                   id="perm<?php echo e($p->id); ?>"
                                   <?php echo e(in_array($p->id, $rolePerms) ? 'checked' : ''); ?>

                                   style="width: 2.5em; height: 1.25em; cursor: pointer;">
                            <span class="form-check-label fw-bold text-dark text-break" style="cursor: pointer;">
                                <?php echo e(str_replace('-', ' ', Str::title($p->name))); ?>

                            </span>
                        </div>
                    </label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Centang permission yang ingin diberikan ke role ini.
                </div>

                <button type="submit" class="btn btn-success rounded-3">
                    <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\esertifikatv1\resources\views/admin/roles/edit.blade.php ENDPATH**/ ?>