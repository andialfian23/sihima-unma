<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Masukan Kode OTP Anda</title>
  <link rel="apple-touch-icon" href="<?= UNMAKU ?>assets/images/logo_mono.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?= UNMAKU ?>assets/images/logo_mono.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?= UNMAKU ?>themes/vendors/line-awesome/css/line-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?= UNMAKU ?>themes/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="<?= UNMAKU ?>themes/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="<?= UNMAKU ?>themes/vendors/css/forms/icheck/custom.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="<?= UNMAKU ?>themes/css/app.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?= UNMAKU ?>themes/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="<?= UNMAKU ?>themes/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?= UNMAKU ?>themes/css/pages/login-register.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link href="<?= base_url('assets/') ?>pincode-input/css/bootstrap-pincode-input.css" rel="stylesheet">
  <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0 text-center">
                  <img src="<?= base_url('assets/images/logo_mono.png') ?>" width="100px" alt="unlock-user" class="rounded-circle img-fluid center-block">
                  <h5 class="card-title mt-1">SIHIMA-UNMA</h5>
                  <p>Sistem Informasi Manajemen Himpunan Mahasiswa<br>Universitas Majalengka</p>
                </div>
                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                  <span>Masukan Kode OTP</span>
                </p>
                <div class="card-content">
                  <div class="card-body text-center">
                    <input type="text" id="otp_input">
                    <div class="text-center" id="verify"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script type="text/javascript" src="<?= base_url('assets/') ?>jquery/jquery.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/') ?>pincode-input/js/bootstrap-pincode-input.js"></script>
  <!-- END PAGE LEVEL JS-->
  <script type="text/javascript">
    setTimeout(function() {
      window.close();
    }, 100000);
    $(document).ready(function() {
      $('#otp_input').pincodeInput({
        inputs: 6,
        hidedigits: false,
        complete: function(value, e, errorElement) {
          console.log(value);
          $.ajax({
            type: "POST",
            url: "<?= base_url('auth/otp') ?>",
            cache: false,
            data: {
              id: value,
              proc: "g2fa"
            },
            success: function(respond) {
              $("#verify").html(respond);
            }
          })
        }
      }).data('plugin_pincodeInput').focus();
    });
  </script>
</body>

</html>