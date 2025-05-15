<?php
session_start();

$link = mysqli_connect("localhost","root","","coursebox");


if(mysqli_connect_errno())
    exit("شرح خطا". mysqli_connect_error());


$pro_code = 0;
if(isset($_GET['id']))
    $pro_code = $_GET['id'];


if(!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)){
    ?>
    <script type="text/javascript">
        <!--
        alert("براي خريد دوره ابتدا بايد وارد سايت شويد");
        location.replace("index.php");	 // منتقل شود index.php به صفحه
        -->
    </script>
    <?php
    exit();
} //if
$query = "SELECT*FROM products WHERE pro_code = '$pro_code'";
$result = mysqli_query($link,$query);
if($row = mysqli_fetch_array($result))
?>

    <script type="text/javascript">
        <!--
        function calc_price()
            {
                var pro_qty = <?php echo($row['pro_qty'])?>;
                var price = document.getElementById('pro_price').value;
                var count = document.getElementById('pro_qty').value;
                var total_price;

                if(count>pro_qty){
                    alert('تعداد موجودی انبار کمتر از درخواست شما است !!');
                    document.getElementById('pro_qty').value = 0;
                    count = 0;
                }

                if(count==0 || count=="")
                    total_price=0;
                else
                    total_price=count*price;

                document.getElementById('total_price').value = total_price;
            }
        -->
    </script>


<?php
$query = "SELECT*FROM users WHERE username='{$_SESSION['username']}'";
$result = mysqli_query($link,$query);
$user_row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <script type="text/javascript">
        <!--
				function check_input()
                {
                    var r = confirm("از صحت اطلاعات وارد شده اطمینان دارید ؟");
                    if(r == true){
                        var validation=true;
                        var count=document.getElementById('pro_qty').value;
                        var mobile=document.getElementById('mobile').value;
                        var address=document.getElementById('address').value;

                        if(count==0 || count=="")
                            validation=false;


                        if(mobile.length<11)
                            validation=false;


                        if(address.length<15)
                            validation=false;


                        if(validation)
                            document.order.submit();
                        else
                            alert('برخی از ورودی های فرم سفارش محصول به درستی پر نشده اند')
                    }
                }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourseBox - ثبت نام دوره</title>
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
                    <a class="nav-link" href="index.php">خانه</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Order Form Section -->
<section class="py-5">
    <div class="container">
        <h1 class="mb-4">ثبت نام دوره</h1>

        <div class="row">
            <!-- Left column - Order form fields -->
            <div class="col-lg-8">
                <!-- Selected Course Information Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">اطلاعات دوره انتخاب شده</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <img src="image/<?php echo($row['pro_image'])?>" height="200" width=200 class="img-fluid rounded" alt="">
                            </div>
                            <div class="col-md-8">
                                <h4 class="mb-2">آموزش <?php echo($row['pro_name'])?></h4>
                                <p class="text-muted mb-2">کد دوره: <?php echo($row['pro_code'])?></p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-light rounded-circle p-1 me-2">
                                        <i class="bi bi-clock text-primary"></i>
                                    </div>
                                    <span>تعداد هنرجویان :  <?php echo($row['pro_qty'])?></span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-light rounded-circle p-1 me-2">
                                        <i class="bi bi-bar-chart text-primary"></i>
                                    </div>
                                    <span>سطح: مبتدی تا پیشرفته</span>
                                </div>
                                <div class="bg-light p-3 rounded">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0">قیمت دوره:</h5>
                                        <h5 class="text-primary mb-0"><?php echo number_format($row['pro_price']) ?> ریال</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5 class="border-bottom pb-2 mb-3">توضیحات </h5>
                            <p>
                                ما برای شما دوره های جامع و کاربردی برای یادگیری زبان برنامه‌نویسی مختلف از سطح مبتدی تا پیشرفته در نظر گرفتیم . در دوره ها شما با مفاهیم اساسی زبان های برنامه نویسی آشنا می‌شوید و قادر خواهید بود برنامه‌های کاربردی ایجاد کنید.
                            </p>
                            <p>
                                این دوره شامل پروژه‌های عملی متعددی است که به شما کمک می‌کند مفاهیم آموخته شده را در عمل پیاده‌سازی کنید.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Student Information Card - Step 2 -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">اطلاعات دانشجو</h5>
                    </div>
                    <div class="card-body">
                        <form id="order" method="post" action="action_orders.php">
                            <!-- Name fields -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">نام دوره</label>
                                    <input type="text" class="form-control" id="pro_name" name="pro_name" value="<?php echo ($row['pro_name']);?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">کد دوره</label>
                                    <input type="number" class="form-control" id="pro_code" name="pro_code" value="<?php echo ($pro_code);?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">قیمت دوره</label>
                                    <input type="number" class="form-control" id="pro_price" name="pro_price" value="<?php echo ($row['pro_price']);?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">مبلغ قابل پرداخت</label>
                                    <input type="number" class="form-control" id="total_price" name="total_price" value="<?php echo ($row['pro_price']+250000);?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">ظرفیت گرفته شده </label>
                                    <input type="number" class="form-control" id="pro_qty" name="pro_qty" value="1" onChange="calc_price();" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">نام و نام خانوادگی</label>
                                    <input id="realname" name="realname" type="text" class="form-control" value="<?php echo($user_row['realname']);?>" readonly>
                                </div>
                            </div>
                            <!-- Contact information -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">ایمیل</label>
                                    <input id="email" name="email" type="email" class="form-control" value="<?php echo($user_row['email']);?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">شماره موبایل</label>
                                    <input id="mobile" name="mobile" type="tel" class="form-control" placeholder="شماره موبایل خود را وارد کنید" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                    <label for="address" class="form-label">آدرس دقیق پستی جهت دریافت محصول</label>
                                    <textarea class="form-control" id="address" name="address" style="text-align: right;" wrap="virtual"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right column - Order summary -->
            <div class="col-lg-4">
                <!-- Order Summary Card -->
                <div class="card shadow-sm mb-4 sticky-top" style="top: 20px; z-index: 100;">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">خلاصه سفارش</h5>
                    </div>
                    <div class="card-body">
                        <!-- Selected course summary -->
                        <div class="d-flex justify-content-between mb-2">
                            <span>آموزش جاوااسکریپت</span>
                            <span><?php echo number_format($row['pro_price']);?> ریال</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>مالیات بر ارزش افزوده</span>
                            <span>250,000 ریال</span>
                        </div>
                        <hr>
                        <!-- Order total -->
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">مبلغ قابل پرداخت</span>
                            <span class="fw-bold fs-5"><?php echo number_format($row['pro_price']+250000);?> ریال</span>
                        </div>
                        <!-- Place order button -->
                        <div class="d-grid">
                            <button form="order" onClick="check_input();" class="btn btn-primary btn-lg">ثبت نام و پرداخت</button>
                        </div>
                        <!-- Terms agreement text -->
                        <div class="text-center mt-3">
                            <small class="text-muted">با ثبت نام، شما <a href="#">قوانین و مقررات</a> سایت را می‌پذیرید.</small>
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

