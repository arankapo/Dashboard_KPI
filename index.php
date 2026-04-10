<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Kinerja MSE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><img src="app/image/mse.png"><b> E-Kinerja</b></a>
      </div>
      <div class="card-body">
    <?php
    if (isset($_GET['error'])) {
      $error = $_GET['error'];
      $msg = '';
      if ($error == 'empty_both') {
        $msg = 'Username dan Password harap diisi.';
      } elseif ($error == 'empty_username') {
        $msg = 'Username harus diisi.';
      } elseif ($error == 'empty_password') {
        $msg = 'Password harus diisi.';
      } elseif ($error == 'wrong_password') {
        $msg = 'Password salah. Mohon masukkan password yang benar';
      } elseif ($error == 'not_found') {
        $msg = 'Username tidak terdaftar dalam sistem kami.';
      } elseif ($error == 'db_prepare_error') {
        $msg = 'Terjadi kesalahan pada sistem. Silakan hubungi Tim IT terkait.';
      }
      if ($msg) {
        echo '<div class="alert alert-danger text-center">'.$msg.'</div>';
      }
    }
    ?>
         <p class="login-box-msg"><b>PT. Mega Surya Eratama</b></p>  

        <form action="conf/login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name='password'>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                
                <label for="remember">
                
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

  <!--      <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p>
		-->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>