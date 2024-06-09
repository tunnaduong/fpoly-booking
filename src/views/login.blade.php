<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./../public/vendors/feather/feather.css">
    <link rel="stylesheet" href="./../public/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="./../public/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./../public/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="./../public/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="./../public/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="./../public/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="./../public/images/favicon.png" />

</head>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="./../public/images/logo.svg" alt="logo">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>

                            <div class="pt-3">

                                <form action="<?= BASE_URL ?>login" method="POST">

                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                            placeholder="Username">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="pass" class="form-control form-control-lg"
                                            id="exampleInputPassword1" placeholder="Password">
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            >SIGN IN</button>
                                    </div>

                                </form>

                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                                <div class="mb-2">
                                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="ti-facebook mr-2"></i>Connect using facebook
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="register.html" class="text-primary">Create</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>


    <!-- plugins:js -->
    <script src="./../public/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="./../public/js/off-canvas.js"></script>
    <script src="./../public/js/hoverable-collapse.js"></script>
    <script src="./../public/js/template.js"></script>
    <script src="./../public/js/settings.js"></script>
    <script src="./../public/js/todolist.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
