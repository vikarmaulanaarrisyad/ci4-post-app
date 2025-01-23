<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>" class="h1"><b>Silahkan Login</b></a>
            </div>
            <div class="card-body">
                <?= form_open('login/cekuser') ?>
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <?php
                    $isInvalidUsername = (session()->getFlashdata('username')) ? 'is-invalid' : '';
                    ?>

                    <input type="text" name="username" class="form-control <?= $isInvalidUsername ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>

                    <?php
                    if (session()->getFlashdata('username')) {
                        echo '<div id="validationServer03Feedback" class="invalid-feedback">
                            ' . session()->getFlashdata('username') . '
                            </div>';
                    }

                    ?>
                </div>
                <div class="input-group mb-3">
                    <?php
                    $isInvalidPassword = (session()->getFlashdata('password')) ? 'is-invalid' : '';
                    ?>
                    <input type="password" name="password" class="form-control <?= $isInvalidPassword ?>" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?php
                    if (session()->getFlashdata('password')) {
                        echo '<div id="validationServer03Feedback" class="invalid-feedback">
                            ' . session()->getFlashdata('password') . '
                            </div>';
                    }
                    ?>
                </div>
                <div class="row">

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?= form_close(); ?>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>