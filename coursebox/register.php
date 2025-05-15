<?php
session_start();
if (isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true)
{
    ?>
    <script type="text/javascript">
        <!--
        location.replace("index.php");
        -->
    </script>
    <?php
}
?>
<script type="text/javascript">
    <!--
    function check_empty()
    {
        var username='';
        username= document.getElementById("username").value;
        if (username=='')
            alert('وارد كردن نام كاربري الزامي است');
        else
        {

            var r = confirm("از صحت اطلاعات وارد شده اطمینان دارید؟");
            if (r == true) {
                document.register.submit();
            }

        }
    }
    -->
</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coursebox - ثبت نام</title>
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

  <!-- Registration Form -->
  <section class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <div class="card shadow">
            <div class="card-body p-5">
              <h2 class="text-center mb-4">ساخت اکانت کاربری</h2>
                <form name="register" action="action_register.php"  method="POST" >
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="firstName" class="form-label">نام و نام خانوادگی</label>
                    <input type="text" class="form-control" name="realname" id="realname" placeholder="نام کامل را وارد کنید" required>
                  </div>
                  <div class="col-md-6">
                    <label for="lastName" class="form-label">نام کاربری</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="نام کاربری را وارد کنید" required>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">آدرس ایمیل</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                  </div>
                  <div class="form-text">ما هرگز ایمیل شما را با هیچ کس دیگری به اشتراک نمی‌گذاریم</div>
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">شماره همراه</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input style="text-align: right;" type="tel" class="form-control" name="phone" id="phone" placeholder="09XXXXXXXXX">
                  </div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">رمزعبور</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" name="password" id="password" placeholder="رمز عبور خود را وارد کنید" required>
                  </div>
                  <div class="form-text">رمز عبور باید حداقل ۸ کاراکتر داشته باشد</div>
                </div>
                <div class="mb-3">
                  <label for="confirmPassword" class="form-label">تکرار رمزعبور</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" name="repassword" id="repassword" placeholder="رمز عبور خود را تایید کنید" required>
                  </div>
                </div>
                  <div style="text-align: right; direction: rtl;" class="mb-3">
                  <input type="checkbox" class="form-check-input" id="terms" required>
                  <label class="form-check-label" for="terms">من با <a href="#"> شرایط خدمات </a> و <a href="#">سیاست حفظ حریم خصوصی موافقم</a></label>
                </div>
                <div class="d-grid">
                  <button onclick="check_empty()"; type="submit" class="btn btn-primary btn-lg">ساخت حساب کابری</button>
                </div>
              </form>
              <hr class="my-4">
              <div class="text-center">
                <p>حساب کاربری دارید؟ <a href="login.php" class="text-decoration-none">وارد شوید </a></p>
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
