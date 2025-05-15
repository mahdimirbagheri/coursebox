<?php
session_start();
if(isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true && $_SESSION["user_type"]=="public")
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

<?php
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] ==
    "admin")) {
    ?>
    <script type="text/javascript">
        <!--
        location.replace("index.php");
        -->
    </script>
    <?php
}

if (!(isset($_GET['action']) && $_GET['action']=='DELETE') ){

    if (isset($_POST['pro_code']) && !empty($_POST['pro_code']) && isset($_POST['pro_name']) &&
        !empty($_POST['pro_name']) && isset($_POST['pro_qty']) && !empty($_POST['pro_qty']) &&
        isset($_POST['pro_price']) && !empty($_POST['pro_price']) && isset($_POST['pro_type']) &&
        !empty($_POST['pro_type'])) {

        $pro_code = $_POST['pro_code'];
        $pro_name = $_POST['pro_name'];
        $pro_qty = $_POST['pro_qty'];
        $pro_price = $_POST['pro_price'];
        $pro_image = $_FILES["pro_image"]["name"];
        $pro_type = $_POST['pro_type'];


    } else
        exit("برخی از فیلد ها مقدار دهی نشده است");

}

$link = mysqli_connect("localhost", "root", "", "coursebox");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

if (isset($_GET['action'])) {

    $id = $_GET['id'];

    switch ($_GET['action']) {
        case 'EDIT':
            $query = "UPDATE products SET
                        pro_code='$pro_code',
                        pro_name='$pro_name',
                        pro_qty='$pro_qty',
                        pro_price='$pro_price',
                        pro_type ='$pro_type'
                         
                         WHERE pro_code='$id'";

            if (mysqli_query($link, $query) === true)
                echo ("<p style='color:green;'><b>محصول انتخاب شده با موفقيت ويرايش شد</b></p>");
            else
                echo ("<p style='color:red;'><b>خطا در ويرايش محصول</b></p>");

            break;

        case 'DELETE':
            $query = "SELECT pro_image  FROM products
                        WHERE pro_code='$id'";
            $result=mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            $pro_image = $row['pro_image'];

            $query = "DELETE  FROM products
                        WHERE pro_code='$id'";

            if (mysqli_query($link, $query) === true){
                ?>
                <script type="text/javascript">
                    <!--
                    alert("محصول انتخاب شده با موفقيت حذف شد");
                    location.replace("dashboard.php");
                    -->
                </script>
                <?php
                unlink("image/".$pro_image);
            }
            else
                echo ("<p style='color:red;'><b>خطا در حذف محصول</b></p>");

            break;

    }
    mysqli_close($link);
    exit();

}


$target_dir = "D:\wamp64\www\image";
$target_file = $target_dir.$_FILES["pro_image"]["name"];
$uploadOK = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);



$check = getimagesize($_FILES['pro_image']["tmp_name"]);
if($check !== false)
{
    echo("پرونده انتخابي يک تصوير از نوع " . $check["mime"] . "است <br />");
    $uploadOk = 1 ;
}
else
{
    echo("فايل انتخاب شده یک تصوير نيست <br/>");
    $uploadOk = 0 ;
}



if(file_exists($target_file))
{
    echo("پرونده ای یا همین نام در سرویس دهنده میزبان وجود دارد");
    $uploadOk = 0 ;
}



if($_FILES["pro_image"]["size"] > (500 * 1024))
{
    echo("سايز فايل انتخابي بيشتر از 500 کيلوبايت است <br/>");
    $uploadOk  = 0 ;
}



$imageFileType != Strtolower($imageFileType);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif")
{
    echo(" فقط پسوند های jpg,jpeg,ong,gif برای پرونده مجاز هستند <br />");
    $uploadOk  = 0 ;
}




if($uploadOk == 0)
{
    echo("پرونده انتخاب شده به سرويس دهنده ميزبان ارسال نشد <br />");
}
else
{
    if(move_uploaded_file($_FILES["pro_image"]["tmp_name"], $target_file)) {

        echo("پرونده" . $_FILES["pro_image"]["tmp_name"].
            "با موفقيت به سرويس دهنده ميزبان انتقال يافت <br />");

    }
    else
    {
        echo("خطا در ارسال پرونده به سرويس دهنده ميزبان رخ داده است <br />");
    }
}
$link = mysqli_connect("localhost","root","","coursebox");
if($uploadOk == 1)
{
    $query = "INSERT INTO products
			( pro_code , pro_name , pro_qty , pro_price , pro_image , pro_type ) VALUES 
            ('$pro_code' , '$pro_name' , '$pro_qty' , '$pro_price' , '$pro_image' , '$pro_type')";


    if(mysqli_query($link,$query) === true)
    {
        ?>
        <script type="text/javascript">
            <!--
            alert("کالا با موفقيت به انبار اضافه شد")
            location.replace("dashboard.php");
            -->
        </script>
        <?php
    }

    else
    {
        ?>
        <script type="text/javascript">
            <!--
            alert("خطا در ثبت مشخصات کالا در انبار")
            location.replace("index.php");
            -->
        </script>
        <?php
    }
}
else
{
    ?>
    <script type="text/javascript">
        <!--
        alert("خطا در ثبت مشخصات کالا در انبار")
        location.replace("index.php");
        -->
    </script>
    <?php
}


mysqli_close($link);

