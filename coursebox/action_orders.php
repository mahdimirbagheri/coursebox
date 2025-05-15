<?php
session_start();
if(!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)){
   ?> 
   <script type="text/javascript">
	location.replace("index.php");
</script>
<?php

}
$pro_code = $_POST['pro_code'];
$pro_name = $_POST['pro_name'];
$pro_qty = $_POST['pro_qty'];
$pro_price = $_POST['pro_price'];
$total_price = $_POST['total_price'];
$realname = $_POST['realname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];

$username = $_SESSION['username'];


$query = "INSERT INTO orders 
(id,
username,
orderdate,
pro_code,
pro_qty,
pro_price,
mobile,
address,
trackcode,
state) VALUES 
('0',
'$username',
'".date('y-m-d')."',
'$pro_code',
'$pro_qty',
'$pro_price',
'$mobile',
'$address',
'000000000000000000000000',
'0')";

$link = mysqli_connect("localhost","root","","coursebox");
if(mysqli_query($link,$query)=== true){
?>
    <script type="text/javascript">
    <!--
    alert("سفارش شما با موفقيت در سامانه ثبت شد")
    alert("جناب آقا/خانم <?php echo($realname)?> دوره دسترسی شما به دوره در اولین فرصت در تلگرام داده خواهد شد ")
    location.replace("index.php");
    -->
    </script>
<?php
    $query = "UPDATE products SET pro_qty = pro_qty-$pro_qty WHERE pro_code='$pro_code'";
    mysqli_query($link,$query);
}
else{
?>
<script type="text/javascript">
    <!--
    alert("سفارش شما مورد دچار مشکل شده")
    location.replace("index.php");
    -->
</script>
<?php
}
mysqli_close($link);
?>

