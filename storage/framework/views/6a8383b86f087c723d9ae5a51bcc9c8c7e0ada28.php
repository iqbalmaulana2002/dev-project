<?php $__env->startSection('title', 'Cek Absen'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-6 mx-auto">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nama User</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Masuk pukul: (waktu saat ini)</li>
                        <li>Tanggal: (tanggal saat ini)</li>
                        <li>Keterangan: Masuk</li>
                    </ul>
                </div>
                <div class="row mb-3">
                    <div class="col text-center">
                        <a href="/" class="btn btn-info btn-circle btn-sm">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates/template-home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Folder_iqbal\Prakerin\projek_pkl\Program_Cuti\dev-project\resources\views/absen/checkabsen.blade.php ENDPATH**/ ?>