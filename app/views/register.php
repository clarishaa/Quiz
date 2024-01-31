<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../public/vendors/feather/feather.css">
  <link rel="stylesheet" href="../public/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../public/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../public/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../public/images/LOGOJB.png" />
  <style>
    body {
    background-image: url('../images/bubble.jpg');
}
  </style>
</head>

<body>
  <div class="container-scroller" style="color: white;">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="background-color: #0D6EFD;">
              <h4 class="text-center"><b>Register here</b></h4>
              <h6 class="font-weight-light text-center">Please Sign up</h6>            
              <?php $LAVA =& lava_instance(); ?>
              <?php echo $LAVA->form_validation->errors(); ?>         
             <form action="<?= site_url('validate_reg'); ?> " method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="name" placeholder="Username" value="" size="50"style="color: white;">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" value="" size="50" style="color: white;">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" value="" size="50" style="color: white;">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="confpassword" placeholder="Confirm Password" value="" size="50" style="color: white;">
                </div>
                <div class="mt-3 d-flex justify-content-center">
                <div><input type="submit" value="Sign Up" class="btn btn-success" /></div>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
