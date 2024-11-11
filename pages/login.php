<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once("../includes/head.php");
  ?>
</head>

<body>
  <!-- login page start-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-7"><img class="bg-img-cover bg-center" src="../assets/images/login/4.png" alt="looginpage"></div>
      <div class="col-xl-5 p-0">
        <div class="login-card">
          <div>
            <div><a class="logo text-start" href="index.html"><img class="img-fluid for-light" src="../assets/images/sby/logo-disdukcapil-kecil-1.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
            <div class="login-main">
              <form class="theme-form">
                <h4>APLIKASI OMNICHANNEL</h4>
                <p>Disdukcapil Surabaya</p>
                <div class="form-group">
                  <label class="col-form-label">Username</label>
                  <input class="form-control" type="email" required="" placeholder="Masukkan Username">
                </div>
                <div class="form-group">
                  <label class="col-form-label">Password</label>
                  <input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
                  <div class="show-hide"><span class="show"> </span></div>
                </div>
                <div class="form-group mb-0">
                  <div class="checkbox p-0">
                    <input id="checkbox1" type="checkbox">
                    <label class="text-muted" for="checkbox1">Remember password</label>
                  </div>
                  <button class="btn btn-primary btn-block" type="submit">Login</button>
                </div>
                <!-- <h6 class="text-muted mt-4 or">Or Sign in with</h6> -->
                <p class="mt-4 mb-0">Lupa Password ? <a class="ms-2" href="#">Klik disini</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    require_once("../includes/script.php");
    ?>
  </div>
</body>

</html>