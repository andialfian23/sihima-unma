<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Login SIHIMA UNMA">
  <meta name="keywords" content="Login SIHIMA UNMA">
  <meta name="author" content="Andi Alfian">

  <title>Login SIHIMA UNMA</title>

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
  <link href="<?= UNMAKU ?>assets/pincode-input/css/bootstrap-pincode-input.css" rel="stylesheet">
  <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu-modern 1-column menu-expanded blank-page blank-page bg-dark" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
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
                  <h5 class="card-title mt-1">LOGIN SIHIMA UNMA</h5>
                </div>
                <p class="card-subtitle text-muted text-center text-lg mx-2">
                  <span>Masukan NPM / ID Dosen</span>
                </p>
                <div class="card-content">
                  <div class="card-body text-center">
                    <div class="text-center" id="verify"></div>
                    <input type="text" id="username" class="form-control text-lg" placeholder="18.14.1.0001 / 201" maxlength='12' minlength="3">
                    <small id="notif_username" class="text-danger"></small>
                    <button type="submit" class="btn btn-primary mt-1 btn-block" id="btn_login">LOGIN</button>
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
  <script type="text/javascript" src="<?= UNMAKU ?>assets/jquery/jquery.js"></script>
  <!-- END PAGE LEVEL JS-->
  <script type="text/javascript">
    $(function() {

      $('#username').on('keyup', function() {
        if (event.keyCode == 13) {
          if ($('#username').val() == '') {
            $('#username').addClass('border border-danger');
            $('#notif_username').html('Input Belum Di isi');
            return false;
          }

          login();
        }
      });

      $('#btn_login').click(function() {

        if ($('#username').val() == '') {
          $('#username').addClass('border border-danger');
          $('#notif_username').html('Input Belum Di isi');
          return false;
        }

        login();
      });

      function login() {
        $.ajax({
          url: '<?= base_url() ?>Auth/login',
          type: 'POST',
          data: {
            id: $('#username').val(),
          },
          dataType: 'json',
          success: function(res) {
            if (res.status === 1) {
              const base_url = "<?= basE_url() ?>Dashboard";

              $('#verify').html(`<div class="alert alert-success border-0 my-2" role="alert">
                                    <strong>Berhasil!</strong> Username yang anda masukkan Valid. </div>
                                  <div class="alert border-0" role="alert">
                                    <i class="la la-spinner spinner"></i> 
                                    Anda akan diarahkan ke halaman utama dalam <div id="countdown">3 detik</div>. 
                                    Atau klik <a class="alert-link" href="` + base_url + `">disini</a></div>`);
              var timeleft = 2;
              var downloadTimer = setInterval(function() {
                $("#countdown").html(timeleft + " detik");
                timeleft -= 1;
                if (timeleft <= 0) {
                  clearInterval(downloadTimer);
                  $("#countdown").html("Go..")
                }
              }, 1000);
              setTimeout(function() {
                window.location.replace(base_url);
              }, 1000);

            } else {
              $('#verify').html(`<div class="alert alert-danger border-0 my-2" role="alert">` + res.pesan + `</div>`);
              $('#input').addClass('is-invalid');
            }
          }
        });

      }
    });
  </script>
</body>

</html>