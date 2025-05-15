<?php
session_start();
$link = mysqli_connect("localhost","root","","coursebox");

if(mysqli_connect_errno())
    exit("Error description :". mysqli_connect_error());
$query = "SELECT*FROM products";
$result = mysqli_query($link,$query);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CourseBox - صفحه اصلی</title>
  <!-- Bootstrap RTL CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Vazirmatn Font (Persian) -->
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">CourseBox</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">صفحه اصلی</a>
          </li>
            <?php
            if(isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true && $_SESSION["user_type"]=="admin")
            {
                ?>
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">مدیریت محصولات</a>
                </li>
                <?php
            }
            if(isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true && $_SESSION["user_type"]=="admin")
            {
                ?>
                <li class="nav-item">
                    <a href="admin_manage_order.php" class="nav-link">مدیریت سفارشات</a>
                </li>
                <?php
            }
            ?>

        </ul>
        <div class="d-flex">
            <a href="register.php" class="btn btn-light">ثبت نام</a>
            <?php
            if (isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true)
            {
                ?>
                <a href="logout.php" class="btn btn-outline-light ms-2">خروج</a>
                <?php
            } // if
            else
            {
                ?>
                <a href="login.php" class="btn btn-outline-light ms-2">ورود</a>
                <?php
            } // else
            ?>

        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="hero-section text-white text-center">
    <div class="container px-4 py-5">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="src/edu.png" class="d-block mx-lg-auto img-fluid" alt="آموزش آنلاین" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold lh-1 mb-3">یادگیری آسان با CourseBox</h1>
          <p class="lead">دوره‌های آموزشی با کیفیت با قیمت‌های استثنایی. به هزاران دانشجوی راضی بپیوندید.</p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="#featured-courses" class="btn btn-primary btn-lg px-4 ms-md-2">مشاهده دوره‌ها</a>
            <a href="register.php" class="btn btn-outline-light btn-lg px-4">ثبت نام</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Featured Courses -->
  <section id="featured-courses" style="text-align: center" class="py-5">
      <div class="container">
          <h2 class="text-center mb-4">دوره‌های کورس باکس</h2>
          <div class="row g-4">
              <?php
              $counter = 0;
              while($row = mysqli_fetch_array($result)){
                  $counter++;
                  ?>
                  <div class="col-md-3">
                      <div class="card h-100">
                          <div class="badge bg-danger position-absolute top-0 start-0 m-2"><?php echo($row['pro_qty'])?></div>
                          <a href="product_detail.php?id=<?php echo($row['pro_code'])?>">
                              <img src="image/<?php echo($row['pro_image'])?>" class="card-img-top" alt="دوره 1">
                          </a>
                          <div class="card-body">
                              <h5 class="card-title"><?php echo($row['pro_name']) ?></h5>
                              <p class="fw-bold"><?php echo number_format($row['pro_price']) ?> ریال </p>
                              <a href="product_detail.php?id=<?php echo($row['pro_code']) ?>" class="btn btn-primary w-100">ثبت نام دوره</a>
                          </div>
                      </div>
                  </div>

                  <?php
                  // Check if 4 items are displayed to start a new row
                  if($counter % 4 == 0) {
                      echo('</div><div class="row g-4">');
                  }
              }
              ?>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">نظرات دانشجویان</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="d-flex justify-content-center mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </div>
              <p class="card-text text-center">"دوره‌های با کیفیت و اساتید حرفه‌ای. قطعاً دوره‌های بیشتری خواهم گذراند!"</p>
              <p class="text-center fw-bold mb-0">- سارا جمشیدی</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="d-flex justify-content-center mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
              </div>
              <p class="card-text text-center">"پشتیبانی عالی و پاسخگویی سریع به سؤالات. دقیقاً همان چیزی که نیاز داشتم."</p>
              <p class="text-center fw-bold mb-0">- محمد تهرانی</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="d-flex justify-content-center mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </div>
              <p class="card-text text-center">"دوره‌های با کیفیت با قیمت مناسب. وب‌سایت کاربرپسند و فرآیند ثبت نام آسان است."</p>
              <p class="text-center fw-bold mb-0">- لیلا رضایی</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="py-5 bg-primary text-white">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <h2 class="mb-3">عضویت در خبرنامه</h2>
          <p class="mb-4">از آخرین دوره‌ها، تخفیف‌ها و پیشنهادات ویژه مطلع شوید.</p>
          <form class="row g-3 justify-content-center">
            <div class="col-md-8">
              <input type="email" class="form-control form-control-lg" placeholder="آدرس ایمیل شما">
            </div>
            <div class="col-md-auto">
              <button type="submit" class="btn btn-light btn-lg">عضویت</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-dark text-white">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <h5>CourseBox</h5>
          <p>مرجع آموزش آنلاین با کیفیت. دوره‌های متنوع، قیمت‌های مناسب و پشتیبانی عالی.</p>
        </div>
        <div class="col-md-2">
          <h5>دوره‌ها</h5>
          <ul class="nav flex-column">
            <li class="nav-item"><a href="dashboard.html" class="nav-link text-white p-0">همه دوره‌ها</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white p-0">تخفیف‌ها</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white p-0">دوره‌های جدید</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white p-0">پرفروش‌ترین‌ها</a></li>
          </ul>
        </div>
        <div class="col-md-2">
          <h5>حساب کاربری</h5>
          <ul class="nav flex-column">
            <li class="nav-item"><a href="login.php" class="nav-link text-white p-0">ورود</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link text-white p-0">ثبت نام</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white p-0">سفارش‌ها</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white p-0">پروفایل</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>تماس با ما</h5>
          <address>
            <p class="mb-1"><i class="bi bi-geo-alt-fill ms-2"></i>البرز، کرج، خیابان برغان، پلاک ۱۲۳</p>
            <p class="mb-1"><i class="bi bi-telephone-fill ms-2"></i>۰۲۶-۱۲۳۴۵۶۷۸</p>
            <p class="mb-1"><i class="bi bi-envelope-fill ms-2"></i>info@coursebox.ir</p>
          </address>
          <div class="d-flex gap-3 mt-3">
            <a   href="#" class="text-white"><i class="bi bi-instagram fs-4"></i></a>
            <a href="#" class="text-white"><i class="bi bi-telegram fs-4"></i></a>
            <a href="#" class="text-white"><i class="bi bi-twitter fs-4"></i></a>
            <a href="#" class="text-white"><i class="bi bi-linkedin fs-4"></i></a>
          </div>
        </div>
      </div>
      <hr class="my-4">
      <div class="row">
        <div class="col-md-6">
          <p class="mb-0">© 1404 CourseBox تمامی حقوق محفوظ است.</p>
        </div>
        <div class="col-md-6 text-md-start">
          <ul class="list-inline mb-0">
            <li class="list-inline-item"><a href="#" class="text-white">حریم خصوصی</a></li>
            <li class="list-inline-item"><a href="#" class="text-white">قوانین و مقررات</a></li>
            <li class="list-inline-item"><a href="#" class="text-white">سؤالات متداول</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
