<?php 
require 'koneksi.php';
error_reporting(0);
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: loginDokter.php");
}

if (isset($_POST['save'])){
  $nama_baru = $_POST['newNama'];
  $username_baru = $_POST['newUsername'];
  $password_baru = $_POST['newPassword'];
  $alamat_baru = $_POST['newAlamat'];
  $no_ktp_baru = $_POST['newNoKTP'];
  $no_hp_baru = $_POST['newNoHP'];

  $queri0 = mysqli_query($mysqli, "SELECT * FROM pasien WHERE no_ktp='$no_ktp_baru'");
  if ($queri0->num_rows > 0) {
    echo "<script>alert('Maaf tapi No KTP sudah teregistrasi!');
        window.location.href = 'dataPasien.php';
            </script>";
  } else{
    if (!empty($_POST['id'])){
      $id_baru = $_POST['id'];
      $queri1 = mysqli_query($mysqli, "UPDATE pasien SET 
          nama='$nama_baru',
          username='$username_baru',
          password='$password_baru', 
          alamat='$alamat_baru',
          no_ktp='$no_ktp_baru',
          no_hp='$no_hp_baru' WHERE id='$id_baru'");
      echo "<script>alert('Selamat, Anda berhasil merubah data Pasien!');
          window.location.href = 'dataPasien.php';
              </script>";
    } else {
      $queri2 = mysqli_query($mysqli, "INSERT INTO 
          pasien(nama,username,password,alamat,no_ktp,no_hp) VALUES(
              '$nama_baru','$username_baru','$password_baru','$alamat_baru','$no_ktp_baru','$no_hp_baru')");
      if($queri2){
          $lastid = $mysqli->insert_id;
          $tahun_sekarang = date("Y");
          $bulan_sekarang = date("m");
          $no_rm_baru = $tahun_sekarang . $bulan_sekarang . "-" . $lastid;
          $queri1 = mysqli_query($mysqli, "UPDATE pasien SET 
              no_rm='$no_rm_baru' WHERE id='$lastid'");
          echo "<script>alert('Selamat, Anda berhasil menambah data Pasien!');
              window.location.href = 'dataPasien.php';
                  </script>";
      }
    }
  }
}

if (isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];
  $id = $_GET['id'];
  if ($aksi == 'hapus') {
    $queri3 = mysqli_query($mysqli, "DELETE FROM pasien 
        WHERE id='$id'");
    echo "<script>alert('Selamat, Anda berhasil menghapus data Pasien!');
        window.location.href = 'dataPasien.php';
            </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data-Pasien | Admin Poliklinik</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Poliklinik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dataDokter.php" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>Data Dokter</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dataPasien.php" class="nav-link active">
              <i class="nav-icon fas fa-procedures"></i>
              <p>Data Pasien</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dataObat.php" class="nav-link">
              <i class="nav-icon fas fa-pills"></i>
              <p>Data Obat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dataPoli.php" class="nav-link">
              <i class="nav-icon fas fa-clinic-medical"></i>
              <p>Data Poli</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pasien</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <form method="POST" class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Form Input Pasien</h3>
              </div>
              <div class="card-body">
                <?php 
                $nama='';
                $username='';
                $password='';
                $alamat='';
                $no_ktp='';
                $no_hp='';
                if (isset($_GET['id'])){
                  $id=$_GET['id'];
                  $queri4 = mysqli_query($mysqli, 
                      "SELECT pasien.* FROM pasien
                      WHERE pasien.id='$id'");
                  while ($row = mysqli_fetch_array($queri4)){
                      $nama = $row['nama'];
                      $username = $row['username'];
                      $password= $row['password'];
                      $alamat = $row['alamat'];
                      $no_ktp = $row['no_ktp'];
                      $no_hp = $row['no_hp'];
                  }?>
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <?php 
                }?>
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Nama:</label>

                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Masukkan Nama" 
                      name="newNama" value="<?php echo $nama?>" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Date mm/dd/yyyy -->
                <div class="form-group">
                  <label>Username:</label>

                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Masukkan Username" 
                      name="newUsername" value="<?php echo $username?>" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Password:</label>

                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Masukkan Password" 
                      name="newPassword" value="<?php echo $password?>" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Date mm/dd/yyyy -->
                <div class="form-group">
                  <label>Alamat:</label>

                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Masukkan Alamat" 
                      name="newAlamat" value="<?php echo $alamat?>" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- phone mask -->
                <div class="form-group">
                  <label>No KTP:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Masukkan Nomor KTP" data-inputmask='"mask": "99-99-99-999999-9999"' data-mask 
                      name="newNoKTP" value="<?php echo $no_ktp?>" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- phone mask -->
                <div class="form-group">
                  <label>No HP:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Masukkan Nomor HP" data-inputmask='"mask": "9999-9999-9999"' data-mask 
                      name="newNoHP" value="<?php echo $no_hp?>" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="save">Submit</button>
              </div>
              <!-- /.card -->
            </form> 

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Tabel Pasien</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Alamat</th>
                    <th>No KTP</th>
                    <th>No Hp</th>
                    <th>No RM</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $i= 1;
                  $queri5 = mysqli_query($mysqli, 
                    "SELECT pasien.* FROM pasien");
                  while ($row = mysqli_fetch_array($queri5)){?>
                    <tr>
                      <td class="text-center" scope="row"><?php echo $i++ ?></td>
                      <td><?php echo $row['nama']?></td>
                      <td><?php echo $row['username']?></td>
                      <td><?php echo $row['password']?></td>
                      <td><?php echo $row['alamat']?></td>
                      <td><?php echo $row['no_ktp']?></td>
                      <td><?php echo $row['no_hp']?>
                      <td><?php echo $row['no_rm']?>
                      <td>
                          <a class="btn btn-info rounded-pill px-3" 
                              href="dataPasien.php?id=<?php echo $row['id'] ?>">Ubah</a>
                          <a class="btn btn-danger rounded-pill px-3" 
                              href="dataPasien.php?id=<?php echo $row['id']?>
                                  &aksi=hapus">Hapus</a>
                      </td>
                    </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>
</body>
</html>