<?php
session_start();
if ( 
	isset($_POST['username']) && !empty($_POST['username']) && 
	isset($_POST['password']) && !empty($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

} 
else
    exit("برخی از فیلد ها مقدار دهی نشده است");
$link = mysqli_connect("localhost","root","","coursebox");
	
	if(mysqli_connect_errno())
	exit("شرح خطا". mysqli_connect_error());

	$query = "SELECT*FROM users WHERE username='$username' AND password='$password'";

	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_array($result);
	if($row)
	{
		
        $_SESSION["state_login"] = true;
        $_SESSION["realname"] = $row['realname'];
		$_SESSION["username"] = $row['username'];
		
        if($row["type"]==0)
            $_SESSION["user_type"]="public";
		
        elseif($row["type"]==1)
            $_SESSION["user_type"]="admin";
		?>
			<script type="text/javascript">
				<!--
    			location.replace("index.php");
    			-->
                    var realname = "<?php echo $row['realname']; ?>";
                    alert( realname + " به فروشگاه خوش اومدی " );
            </script>
<?php
	}
			else
            {
                ?>
                <script type="text/javascript">
                    <!--
                    location.replace("index.php");	 // منتقل شود index.php به صفحه
                    -->
                    alert("رمز عبور یا نام کاربری یافت نشد");
                </script>
                <?php
            }
mysqli_close($link);

?>