<?php session_start(); ?>


<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php

include("mysql_connect.inc.php");

	$id = $_SESSION["id"];

	$name = $_POST["name"];

	$pw = $_POST["pw"];
	
	$pw2 = $_POST["pw2"];

	$sy = $_POST["sy"];

	$mail = $_POST["mail"];

	$phone = $_POST["phone"];
	
if($id == null | $name == null | $pw ==null | $pw2 == null | $sy == null | $mail == null | $phone == null)
{
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '請確認所有欄位皆已輸入!' );";
			echo "history.back();";
			echo "</script>";
}
else{	

if($pw != null && $pw2 != null && $pw == $pw2)

{	

	$query = sprintf("UPDATE madata SET id = '%s', name = '%s', pw = '%s', pw2 = '%s', sy = '%s', mail = '%s', phone = '%s'  WHERE id = '%s'", $id , $name, $pw, $pw2, $sy, $mail, $phone, $id);

	mysqli_query($db, $query) or die(mysqli_error());

			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '修改成功！' );";
			echo "history.back();";
			echo "</script>";
 }

        else
        {
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '您輸入的兩次密碼不同!' );";
			echo "history.back();";
			echo "</script>";
        }

      }
    ?>
</body>
</html>