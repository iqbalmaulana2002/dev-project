<?php $__env->startSection('title', 'Absen'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row mt-3">
        <div class="col">
            <div class="jumbotron mx-auto text-center">
                <h1 class="display-3">Hallo, Nama User!</h1>
                <p class="lead">Selamat datang di fitur absensi (Divisi Digital Service) PT Telekomunikasi Indonesia</p>
                <hr class="my-4">
                <p>Silahkan klik tombol ceklist jika anda ingin absen. Silahkan klik tanda seru jika tidak hadir. Silahkan klik tombol 'i' jika ingin kembali ke home.</p>
                <a href="" class="btn btn-success btn-circle btn-lg" data-toggle="modal" data-target="#absenmodal">
                    <i class="fas fa-check"></i>
                </a>
                <a href="" class="btn btn-warning btn-circle btn-lg" data-toggle="modal" data-target="#izinmodal">
                    <i class="fas fa-exclamation-triangle"></i>
                </a>
                <a href="<?php echo e(url('/')); ?>" class="btn btn-info btn-circle btn-lg">
                    <i class="fas fa-info-circle"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="absenmodal" tabindex="-1" role="dialog" aria-labelledby="absenmodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="absenmodal">Yakin ingin absen?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik 'Absen' jika ingin absen.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="<?php echo e(url('/checkabsen')); ?>">Absen</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="izinmodal" tabindex="-1" role="dialog" aria-labelledby="izinmodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="izinmodal">Tidak masuk?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik 'Izin' jika tidak masuk.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="<?php echo e(url('/izinabsen')); ?>">Izin</a>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates/template-home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\devProject\resources\views/user/absen/index.blade.php ENDPATH**/ ?>