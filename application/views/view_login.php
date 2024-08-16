<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link
    href="<?= base_url() ?>/template_admin/vendor/fontawesome-free/css/all.min.css"
    rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>/template_admin/css/sb-admin.css"
    rel="stylesheet">

</head>

<body class="bg-dark">
  <?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success" role="alert">
    <?php echo $this->session->flashdata('success'); ?>
  </div>
  <?php endif; ?>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header text-center">SELAMAT DATANG DI SISTEM INFORMASI PERSEDIAAN BARANG DENGAN MENGGUNAKAN METODE FUZZY TSUKAMOTO. SILAHKAN LOGIN</div>
      <div class="card-body">
        <?php echo $this->session->flashdata('pesan'); ?>
        <form action="<?= base_url('Login') ?>"
          method="post">
          <?php echo form_error('usernname', '<div class="text-danger small ml-2">', '</div>'); ?>
          <div class="input-group mb-3">
            <input type="text" id="usernname" class="form-control" placeholder="Username" autofocus="autofocus"
              name="usernname">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <?php echo form_error('passsword', '<div class="text-danger small ml-2">', '</div>'); ?>
          <div class="input-group mb-3">
            <input type="password" id="passsword" class="form-control" placeholder="Password" name="passsword">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row align-center">

            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() ?>/template_admin/vendor/jquery/jquery.min.js">
  </script>
  <script
    src="<?= base_url() ?>/template_admin/vendor/bootstrap/js/bootstrap.bundle.min.js">
  </script>

  <!-- Core plugin JavaScript-->
  <script
    src="<?= base_url() ?>/template_admin/vendor/jquery-easing/jquery.easing.min.js">
  </script>

</body>

</html>