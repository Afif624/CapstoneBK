<?php 
require 'koneksi.php';
error_reporting(0);
session_start();

if (isset($_POST['submit'])){
  $nama_baru = $_POST['newNama'];
  $username_baru = $_POST['newUsername'];
  $password_baru = $_POST['newPassword'];
  $alamat_baru = $_POST['newAlamat'];
  $no_ktp_baru = $_POST['newNoKTP'];
  $no_hp_baru = $_POST['newNoHP'];
  $queri1 = mysqli_query($mysqli, "SELECT * FROM pasien WHERE no_ktp='$no_ktp_baru'");
  if ($queri1->num_rows > 0) {
    echo "<script>alert('Maaf tapi No KTP sudah teregistrasi!');
        window.location.href = 'registerPasien.php';
            </script>";
  } else{
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
        echo "<script>alert('Selamat, Anda berhasil registrasi Pasien!');
            window.location.href = 'loginPasien.php';
                </script>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Poliklinik</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary mt-5 mb-5">
    <div class="card-header text-center">
      <a href="index2.html" class="h1"><b>Register</b>POLI</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Lengkapi Data untuk Register</p>

      <form action="" method="post">
        <!-- Date dd/mm/yyyy -->
        <div class="form-group">
          <label>Nama:</label>

          <div class="input-group">
            <input type="text" class="form-control" placeholder="Masukkan Nama" 
              name="newNama" required>
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->

        <!-- Date mm/dd/yyyy -->
        <div class="form-group">
          <label>Username:</label>

          <div class="input-group">
            <input type="text" class="form-control" placeholder="Masukkan Username" 
              name="newUsername" required>
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->

        <!-- Date dd/mm/yyyy -->
        <div class="form-group">
          <label>Password:</label>

          <div class="input-group">
            <input type="password" class="form-control" placeholder="Masukkan Password" 
              name="newPassword" required>
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->

        <!-- Date mm/dd/yyyy -->
        <div class="form-group">
          <label>Alamat:</label>

          <div class="input-group">
            <input type="text" class="form-control" placeholder="Masukkan Alamat" 
              name="newAlamat" required>
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
              name="newNoKTP" required>
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
              name="newNoHP" required>
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->
        <div class="social-auth-links text-center mt-2 mb-3">
          <button type="submit" class="btn btn-primary btn-block" name="submit">Register Sekarang</button>
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="loginPasien.php" class="btn btn-block btn-primary">Menuju Page Login</a>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
