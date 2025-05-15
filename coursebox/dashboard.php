<?php
session_start();
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] ==
    "admin")) {
    ?>
    <script type="text/javascript">
        <!--
        location.replace("index.php");
        -->
    </script>
    <?php
} // if پایان

$link = mysqli_connect("localhost", "root", "", "coursebox");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

$url = $pro_code = $pro_name = $pro_qty = $pro_price = $pro_image = $type = "";

$btn_caption="افزودن كالا";
if (isset($_GET['action']) && $_GET['action'] == 'EDIT') {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE pro_code='$id'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($result)) {
        $pro_code = $row['pro_code'];
        $pro_name = $row['pro_name'];
        $pro_qty = $row['pro_qty'];
        $pro_price = $row['pro_price'];
        $pro_image = $row['pro_image'];
        $pro_type = $row['pro_type'];
        $url = "?id=$pro_code&action=EDIT";
        $btn_caption="ويرايش كالا";

    }

}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourseBox - مدیریت دوره‌ها</title>
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

<!-- Course Management Dashboard -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">

        <!-- New Course Add Form Section - Initially Hidden -->
            <div class="card-body">
                <form name="add_product" id="addCourseForm" action="action_dashboard.php <?php if (!empty($url)) echo($url); ?>"  method="POST" enctype="multipart/form-data" >
                    <div class="row mb-3">
                        <!-- Basic Course Information - First Column -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">اطلاعات پایه دوره</h6>

                            <div class="mb-3">
                                <label for="" class="form-label">کد دوره</label>
                                <input type="text" class="form-control" name="pro_code" id="pro_code" value="<?php echo ($pro_code) ?>" placeholder="کد دوره را وارد کنید">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">نام دوره</label>
                                <input type="text" class="form-control" name="pro_name" id="pro_name" value="<?php echo ($pro_name) ?>" placeholder="نام دوره را وارد کنید">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">قیمت (ریال)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="pro_price" id="pro_price" value="<?php echo ($pro_price) ?>" placeholder="0">
                                    <span class="input-group-text">ریال</span>
                                </div>
                            </div>


                        </div>

                        <!-- Course Details - Second Column -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">جزئیات دوره</h6>

                            <div class="mb-3">
                                <label for="" class="form-label">دسته‌بندی</label>
                                <select name="pro_type" id="pro_type" class="form-select">
                                    <option selected disabled>انتخاب دسته‌بندی</option>
                                    <option value="programming">برنامه‌نویسی</option>
                                    <option value="design">طراحی</option>
                                    <option value="marketing">بازاریابی</option>
                                    <option value="data">علوم داده</option>
                                    <option value="art">هنر و رسانه</option>
                                    <option value="language">زبان</option>
                                    <option value="game">بازی‌سازی</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">ظرفیت</label>
                                <input type="number" class="form-control" value="<?php echo ($pro_qty) ?>" name="pro_qty" id="pro_qty" placeholder="0">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label"></label>
                                <input type="file" class="form-control" value="<?php echo ($pro_image) ?>" name="pro_image" id="pro_image" placeholder="0">
                                <?php if (!empty($pro_image)) echo ("<img class='form-control' src='image/$pro_image'/>"); ?>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-end">
                        <button form="addCourseForm" type="reset" class="btn btn-secondary ms-2" id="cancelAddCourse">انصراف</button> &nbsp;
                        <button type="submit" value="<?php echo ($btn_caption) ?>" class="btn btn-primary">ذخیره دوره</button>
                    </div>
                    <br>
                    <br>
                </form>
            </div>
        </div>

        <!-- Course Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">

                        <?php

                        $query = "SELECT * FROM products";
                        $result = mysqli_query($link, $query);

                        ?>

                        <tr>
                            <th scope="col" class="pe-4">نام دوره</th>
                            <th scope="col">نوع دوره</th>
                            <th scope="col">قیمت</th>
                            <th scope="col">ظرفیت</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col" class="text-start ps-4">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Course 1 -->
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td class="pe-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded ms-3" width="50" src="image/<?php echo ($row['pro_image']) ?>"/>&nbsp;&nbsp;&nbsp;
                                    <div>
                                        <h6 class="mb-0"><?php echo ($row['pro_name']) ?></h6>
                                        <span class="text-muted small"><?php echo ($row['pro_code']) ?></span>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo ($row['pro_type']) ?></td>
                            <td><?php echo ($row['pro_price']) ?>&nbsp; ريال</td>
                            <td><?php echo ($row['pro_qty']) ?></td>
                            <td><span class="badge bg-success">فعال</span></td>
                            <td class="text-start ps-4">
                                <button class="btn btn-sm btn-outline-primary ms-2">
                                    <a style="text-decoration: none;color: inherit;" href="dashboard.php?id=<?php echo ($row['pro_code']) ?>&action=EDIT" style="" class="bi bi-pencil"></a>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <a style="text-decoration: none;color: inherit;" href="action_dashboard.php?id=<?php echo ($row['pro_code']) ?>&action=DELETE" class="bi bi-trash"></a>
                                </button>
                            </td>
                        </tr>
                            <?php
                        } //while
                        ?>
                        </tbody>
                    </table>
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


