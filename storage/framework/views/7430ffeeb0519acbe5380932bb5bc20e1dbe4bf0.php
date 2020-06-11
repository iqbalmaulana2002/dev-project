<?php $__env->startSection('title', 'Daftar Pendidikan'); ?>

<?php $__env->startSection('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col">
            <a href="<?php echo e(url('/admin/pendidikan/create')); ?>" class="btn btn-primary"><i class="fas fa-plus fa-sm"></i> Tambah Pendidikan</a>
        </div>
    </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Data Pendidikan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Pendidikan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
                  <tr align="center">
                      <td><?php echo e($loop->iteration); ?></td>
                      <td><?php echo e($education->pendidikan); ?></td>
                      <td>
                        <a href="<?php echo e(url('/admin/pendidikan/edit/'.$education->id)); ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin?')"><i class="fa fa-edit"></i> <b>Edit</b></a>
                        <form action="<?php echo e(url('/admin/pendidikan/'.$education->id)); ?>" method="POST" class="d-inline">
                          <?php echo method_field('delete'); ?>
                          <?php echo csrf_field(); ?>
                          <button type="submit" class="btn btn-danger btn-sm" name="hapus" onclick="return confirm('Yakin Ingin Menghapus?');"><i class="fa fa-trash"></i> <b>Hapus</b></button>
                        </form>
                      </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates/template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Folder_iqbal\Prakerin\projek_pkl\Program_Cuti\dev-project\resources\views/admin/pendidikan/index.blade.php ENDPATH**/ ?>