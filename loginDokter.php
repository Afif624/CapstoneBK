<?php 
require 'koneksi.php';
error_reporting(0);
session_start();
 
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if (($username == 'admin') && ($password == 'admin')){
    echo "<script>alert('Selamat, Anda berhasil Login!');
        window.location.href = 'admin.php';
            </script>";
  } else {
    $sql1 = "SELECT * FROM dokter WHERE username='$username'";
    $result1 = mysqli_query($mysqli, $sql1);
    if ($result1->num_rows > 0) {
        $sql2 = "SELECT * FROM dokter WHERE password='$password'";
        $result2 = mysqli_query($mysqli, $sql2);
        if ($result2->num_rows > 0) {
            $row = mysqli_fetch_assoc($result1);
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['id'] = $row['id'];
            echo "<script>alert('Selamat, Anda berhasil Login!');
                window.location.href = 'dokter.php';
                    </script>";
        } else {
            echo "<script>alert('Password Anda salah. Silahkan coba lagi!')</script>";
        }
    } else {
        echo "<script>alert('Username Anda salah. Silahkan coba lagi!')</script>";
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
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index2.html" class="h1"><b>Login</b>POLI</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masuk sebagai Admin atau Dokter</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-md"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
          <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
        </div>
      </form>
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
