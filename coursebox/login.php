<?php
    session_start();
    if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true) {
        ?>
        <script type="text/javascript">
        <!--
        location.replace("index.php");	 // منتقل شود index.php به صفحه
        -->
    </script>
    <?php
} // if پایان
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CourseBox - صفحه ورود</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Vazirmatn Font (Persian) -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">CourseBox</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">خانه</a>
          </li>
        </ul>
        <div class="d-flex">
            <a href="register.php" class="btn btn-light">ثبت نام</a>
            <a href="login.php" class="btn btn-outline-light ms-2">ورود</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Login Form -->
  <section class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card shadow">
            <div class="card-body p-5">
              <h2 class="text-center mb-4">ورود به حساب کاربری</h2>
              <form name="login" action="action_login.php"  method="POST" >
                <div class="mb-3">
                  <label for="email" class="form-label">نام کابری</label>
                  <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                      <input type="text" class="form-control" name="username" id="username" placeholder="نام کاربری خود را وارد کنید" required>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">پسورد</label>
                  <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-lock"></i></span>
                      <input type="password" class="form-control" name="password" id="password" placeholder="رمز عبور خود را وارد  کنید" required>
                  </div>
                </div>
                  <div style="text-align: right; direction: rtl;" class="mb-3">
                      <input type="checkbox" class="form-check-input" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">من را به یاد بیاور</label>
                  </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary btn-lg">ورود</button>
                </div>
                <div class="text-center mt-3">
                  <a href="#" class="text-decoration-none">فراموشی رمزعبور؟</a>
                </div>
              </form>
              <hr class="my-4">
              <div class="text-center">
                <p>حساب کاربری نداری؟ <a href="register.php" class="text-decoration-none">ثبت نام کن</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4 bg-dark text-white mt-auto">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="mb-0">© 1404 CourseBox تمامی حقوق محفوظ است.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <ul class="list-inline mb-0">
              <li class="list-inline-item"><a href="#" class="text-white">حریم خصوصی</a></li>&nbsp;&nbsp;
              <li class="list-inline-item"><a href="#" class="text-white">قوانین و مقررات</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
