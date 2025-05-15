<?php
session_start();
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] ==
    "admin")) {
    ?>
    <script type="text/javascript">
        <!--
        location.replace("index.php");	 // منتقل شود index.php به صفحه
        -->
    </script>
    <?php
} // if پایان

$link = mysqli_connect("localhost", "root", "", "coursebox");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());
$query = "SELECT * FROM orders";
$result = mysqli_query($link, $query);

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourseBox - سفارش‌ها</title>
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

<!-- Orders Management -->
<section class="py-5">
    <div class="container">
        <h1 class="mb-4">مدیریت سفارش‌ها</h1>
        <!-- Orders Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="pe-4">شناسه سفارش</th>
                            <th scope="col">دانشجو</th>
                            <th scope="col">نام دوره</th>
                            <th scope="col">تاریخ</th>
                            <th scope="col">مبلغ کل</th>
                            <th>شماره تماس</th>
                            <th>آدرس</th>
                            <th scope="col">وضعیت سفارش</th>
                            <th scope="col" class="text-start ps-4">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Order 1 -->
                        <tr>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                        <tr>
                            <td class="pe-4">
                                <a href="#" class="fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#orderDetailsModal"><?php echo substr($row['trackcode'],3,3) ?></a>
                            </td>
                            <td>
                                <?php
                                $query = "SELECT * FROM users  WHERE username='{$row['username']}'";
                                $result2 = mysqli_query($link, $query);
                                $row_user = mysqli_fetch_array($result2);
                                echo ($row_user['realname'])
                                ?>
                            </td>
                            <td>
                                <?php
                                $query = "SELECT * FROM products WHERE pro_code='{$row['pro_code']}'";
                                $result2 = mysqli_query($link, $query);
                                $row_product = mysqli_fetch_array($result2);
                                echo ($row_product['pro_name'])
                                ?>
                            </td>
                            <td><?php echo ($row['orderdate']) ?></td>
                            <td><?php echo number_format($row['pro_price']) ?>&nbsp; ريال</td>
                            <td><?php echo ($row['mobile']) ?></td>
                            <td><?php echo ($row['address']) ?></td>
                            <td>
                                <?php
                                switch ($row['state']) {
                                    case 0:
                                        ?>
                                        <span class="badge bg-warning text-dark"><?php echo ("تحت بررسی");?></span>
                                        <?php
                                        break;
                                    case 1:
                                        ?>
                                        <span class="badge bg-info"><?php echo ("آماده برای ارسال");?></span>
                                        <?php
                                        break;
                                    case 2:
                                        ?>
                                        <span class="badge bg-success"><?php echo ("ارسال شده ");?></span>
                                        <?php
                                        break;
                                    case 3:
                                        ?>
                                        <span class="badge bg-danger"><?php echo ("سفارش لغو شده است");?></span>
                                        <?php
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <button style="margin: 5px" class="btn btn-sm btn-outline-primary ms-2">
                                    <a  class="bi bi-eye" class="badge bg-warning text-dark" href="action_admin_manage_order.php?id=<?php echo ($row['id']) ?>&action=BARASI" style="text-decoration: none; color: inherit;"></a>
                                </button>
                                <button class="btn btn-sm btn-outline-primary ms-2">
                                    <a  class="bi bi-rocket" href="action_admin_manage_order.php?id=<?php echo ($row['id']) ?>&action=AMADEHERSAL" style="text-decoration: none; color: inherit;"></a>
                                </button>
                                </br>
                                <button class="btn btn-sm btn-outline-primary ms-2">
                                    <a  class="bi bi-send" href="action_admin_manage_order.php?id=<?php echo ($row['id']) ?>&action=ERSALSHODEH" style="text-decoration: none;color: inherit;"></a>
                                </button>
                                <button class="btn btn-sm btn-outline-primary ms-2">
                                    <a  class="bi bi-x" <a href="action_admin_manage_order.php?id=<?php echo ($row['id']) ?>&action=LAGHV" style="text-decoration: none; color: inherit"></a>
                                </button>
                            </td>
                        <?php
                        } //while

                        ?>
                        </tr>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Order Details Modal -->


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
