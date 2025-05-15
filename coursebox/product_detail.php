<?php
session_start();

$link = mysqli_connect("localhost","root","","coursebox");


if(mysqli_connect_errno())	
exit("شرح خطا". mysqli_connect_error());


$pro_code = 0;
if(isset($_GET['id']))
	$pro_code = $_GET['id'];


$query = "SELECT*FROM products WHERE pro_code = '$pro_code'";
$result = mysqli_query($link,$query);


			
if($row = mysqli_fetch_array($result))
{
    ?>
    <!DOCTYPE html>
    <html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CourseBox - جزئیات دوره</title>
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
            </div>
        </div>
    </nav>

    <!-- Course Detail Section -->
    <section class="py-5">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">دوره‌ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> آموزش <?php echo($row['pro_name']);?></li>
                </ol>
            </nav>

            <div class="row">
                <!-- Course Image (Left Side in RTL) -->
                <div class="col-md-5 col-lg-4 order-md-2 mb-4 mb-md-0">
                    <div class="position-relative">
                        <img src="image/<?php echo($row['pro_image'])?>" height=400; width=500; class="img-fluid rounded shadow-sm" alt="آموزش جاوااسکریپت">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 py-2 px-3"><?php echo($row['pro_type']);?></span>
                    </div>
                </div>

                <!-- Course Details (Right Side in RTL) -->
                <div class="col-md-7 col-lg-8 order-md-1">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h1 class="h3 text-primary mb-3">آموزش <?php echo($row['pro_name']);?></h1>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">  کد دوره : <?php echo($row['pro_code']) ?></span>
                                <span class="badge bg-success">در حال ثبت نام</span>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded mb-3 mb-md-0">
                                        <h5 class="mb-2">قیمت دوره:</h5>
                                        <h3 class="text-primary mb-0 price-display">  <?php echo number_format($row['pro_price'])?> ریال </h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded">
                                        <h5 class="mb-2">ظرفیت باقیمانده:</h5>
                                        <h3 class="text-danger mb-0 persian-number"><?php echo($row['pro_qty'])?> نفر</h3>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h5 class="border-bottom pb-2 mb-3">توضیحات </h5>
                            <p>
                                    ما برای شما دوره های جامع و کاربردی برای یادگیری زبان برنامه‌نویسی مختلف از سطح مبتدی تا پیشرفته در نظر گرفتیم . در دوره ها شما با مفاهیم اساسی زبان های برنامه نویسی آشنا می‌شوید و قادر خواهید بود برنامه‌های کاربردی ایجاد کنید.
                            </p>
                            <p>
                                این دوره شامل پروژه‌های عملی متعددی است که به شما کمک می‌کند مفاهیم آموخته شده را در عمل پیاده‌سازی کنید.
                            </p>
                            <div class="d-grid mb-4">
                                <a href="orders.php?id=<?php echo($row['pro_code']) ?>" class="btn btn-primary btn-lg">ثبت نام در دوره</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <h3 class="mb-4">سوالات متداول</h3>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                            آیا پس از خرید دوره، به محتوا دسترسی دائمی خواهم داشت؟
                        </button>
                    </h2>
                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            بله، پس از خرید دوره، دسترسی دائمی به محتوای دوره خواهید داشت و می‌توانید در هر زمان به آن مراجعه کنید. همچنین به‌روزرسانی‌های آینده دوره نیز برای شما رایگان خواهد بود.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                            آیا در طول دوره پشتیبانی ارائه می‌شود؟
                        </button>
                    </h2>
                    <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            بله، در طول دوره می‌توانید سوالات خود را در بخش پرسش و پاسخ مطرح کنید و استاد دوره در اسرع وقت به سوالات شما پاسخ خواهد داد. همچنین یک گروه تلگرامی برای رفع اشکال دانشجویان وجود دارد.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                            آیا در پایان دوره مدرک معتبر ارائه می‌شود؟
                        </button>
                    </h2>
                    <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            بله، پس از اتمام دوره و قبولی در آزمون پایانی، گواهینامه معتبر از CourseBox دریافت خواهید کرد که می‌توانید آن را در رزومه خود قرار دهید.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2>همین امروز یادگیری <?php echo($row['pro_name']);?> را شروع کنید!</h2>
                    <p class="lead mb-0">با ثبت نام در این دوره، اولین قدم را برای تبدیل شدن به یک توسعه‌دهنده وب حرفه‌ای بردارید.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="orders.php?id=<?php echo($row['pro_code']) ?>" class="btn btn-light btn-lg">ثبت نام در دوره</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">© ۱۴۰۲ CourseBox. تمامی حقوق محفوظ است.</p>
                </div>
                <div class="col-md-6 text-md-start">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-white">حریم خصوصی</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white">قوانین و مقررات</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

    <?php

}

?>