<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $__env->yieldContent('title'); ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo e(asset('sbadmin2/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo e(asset('sbadmin2/css/sb-admin-2.min.css')); ?>" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo e(asset('sbadmin2')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  
  <link href="<?php echo e(asset('datepicker.min.css')); ?>" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-danger topbar mb-4 static-top shadow">
            
            <div class="mr-3">
              <img src="<?php echo e(asset('img/logotelkom.jfif')); ?>" class="rounded mr" width="15%">
              <a href="<?php echo e(url('/')); ?>" class="btn btn-danger btn-lg"><i class="fas fa-home"></i></a>
            </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white-600 small"><?php echo e(auth()->user()->nama); ?></span>
              <img class="img-profile rounded-circle" src="<?php echo e(url('img/profile/'. auth()->user()->foto)); ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo e(url('/profile/'.auth()->user()->nama)); ?>">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <?php echo $__env->yieldContent('content'); ?>

        <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="<?php echo e(url('/logout')); ?>" method="GET">
            <?php echo csrf_field(); ?>
            <button class="btn btn-primary" type="submit">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
        
<!-- Bootstrap core JavaScript-->
  <script src="<?php echo e(asset('sbadmin2')); ?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo e(asset('sbadmin2')); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo e(asset('sbadmin2')); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo e(asset('sbadmin2')); ?>/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo e(asset('sbadmin2')); ?>/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo e(asset('sbadmin2')); ?>/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo e(asset('sbadmin2')); ?>/js/demo/chart-pie-demo.js"></script>
  <!-- Page level plugins -->
  <script src="<?php echo e(asset('sbadmin2')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo e(asset('sbadmin2')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo e(asset('sbadmin2')); ?>/js/demo/datatables-demo.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo e(asset('sbadmin2')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo e(asset('sbadmin2')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo e(asset('sbadmin2')); ?>/js/demo/datatables-demo.js"></script>

  
  <script src="<?php echo e(asset('datepicker.min.js')); ?>"></script>

  <script>
    $(document).ready(function (){
      // Script Untuk Absen
      $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
      });
      $("#kategori_name").on('change', function(){
        const kategori = $("#kategori_name").val();
        $.ajax({
          type: 'get',
          dataType: 'html',
          url: '<?php echo e(url('/kategori')); ?>',
          data: 'kategori_id=' + kategori,
          success:function(response){
            $("#barang").html(response);
          }
        });
      });
      
      // $("#kategori").click(function(){
      //   const kategori = $("#kategori").val();
      //   $.ajax({
      //     type: 'get',
      //     dataType: 'html',
      //     url: '<?php echo e(url('/kategori')); ?>',
      //     data: 'kategori_id=' + kategori,
      //     success:function(response){
      //       console.log(response);
      //       $("#barang").html(response);
      //     }
      //   });
      // });
    });
  </script>

<?php echo $__env->yieldContent('footer'); ?>

</body>
</html><?php /**PATH D:\Folder_iqbal\Prakerin\projek_pkl\Program_Cuti\dev-project\resources\views/templates/template-home.blade.php ENDPATH**/ ?>