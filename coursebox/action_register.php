<?php
session_start();
if
    (isset($_POST['realname'])  && !empty($_POST['realname']) &&
	isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['phone']) && !empty($_POST['phone']) &&
	isset($_POST['password']) && !empty($_POST['password']) &&
    isset($_POST['repassword']) && !empty($_POST['repassword']) &&
    isset($_POST['email']) && !empty($_POST['email'])) {

    $realname = $_POST['realname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
}
else
    exit("برخی از فیلد ها مقدار دهی نشده است");


if ($password != $repassword)
    exit("كلمه عبور و تكرار آن مشابه نيست");


if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
    exit("پست اكترونيك وارد شده صحيح نیست");

$link = mysqli_connect("localhost", "root", "", "coursebox");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

$query = "INSERT INTO users (realname, username, email, number, password, type) VALUES ('$realname','$username','$email','$phone','$password','0')";

if (mysqli_query($link, $query) === true){
    ?>
    <script type="text/javascript">
        <!--
        location.replace("index.php");
        -->
        var realname = "<?php echo $realname; ?>";
        alert( realname + " به فروشگاه خوش اومدی ");
    </script>
<?php }
else {
    ?>
    <script type="text/javascript">
        <!--
        location.replace("index.php");	 // منتقل شود index.php به صفحه
        -->
        alert("عضویت شما انجام نشد");
    </script>
    <?php }
mysqli_close($link);

?>
