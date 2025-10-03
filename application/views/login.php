<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login BMN Perpustakaan</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    .login100-form-title {
        display: block;
        font-family: 'Trebuchet MS', sans-serif;
        font-size: 42px;
        font-weight: bold;
        color: #333333;
        text-align: center;
    }

    .login100-form-sub-title {
        display: block;
        font-family: 'Arial', sans-serif;
        font-size: 18px;
        font-weight: bold;
        color: #555555;
        text-align: center;
    }

    .p-b-26 {
        padding-bottom: 26px;
    }
    </style>
</head>

<body class="bg-gradient"
    style="background-image: url('<?php echo base_url('assets/img/perpus/perpus1.jpg'); ?>');background-position: center;background-size: cover;">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center" style="opacity: 0.9;">

            <div class="col-xl-5 col-lg-6 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="<?php echo base_url('assets/img/perpus/logo-perpus.png') ?>"
                                            style="width: 90px;margin-bottom:10px">
                                        <span class="login100-form-title">
                                        </span>
                                        <span class="login100-form-sub-title p-b-26">
                                            Sistem Informasi BMN Perpustakaan UIN Sunan Kalijaga
                                        </span>
                                    </div>

                                    <form method="post" class="user" id="form-login">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="username" placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="password"
                                                placeholder="Enter Password">
                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary btn-user btn-block btn-login">Login</button>
                                    </form>

                                    <!-- <hr> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="#">Lupa password?</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/') ?>js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
    $(document).ready(function() {

        $("#form-login").submit(function(e) {
            e.preventDefault();

            var username = $("#username").val();
            var password = $("#password").val();

            if (username == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username wajib diisi!'
                });
                return false;
            } else if (password == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password wajib diisi!'
                });
                return false;
            } else {
                $.ajax({
                    url: "<?php echo site_url('auth/login'); ?>",
                    type: "POST",
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(response) {
                        response = JSON.parse(response);

                        if (response.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Berhasil!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href =
                                    "<?php echo base_url('dashboard/home'); ?>";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                text: 'Silakan coba lagi!'
                            });
                            $("#username").val('');
                            $("#password").val('');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Server error!'
                        });
                    }
                });
            }
        });

    });
    </script>
</body>

</html>