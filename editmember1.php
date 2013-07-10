<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php



include("mysql_connect.inc.php");



    $id = $_GET["id"];



	$name = $_POST["name"];



	$sy = $_POST["sy"];



	$mail = $_POST["mail"];



	$phone = $_POST["phone"];	



	$Permission = $_POST["Permission"];


    $NY = $_POST["NY"];

	$query = sprintf("UPDATE madata SET id ='%s', name = '%s', sy = '%s', mail = '%s', phone = '%s', Permission = '%s', NY = '%s' WHERE id = '%s'", $id, $name, $sy, $mail, $phone, $Permission, $NY, $id);



	mysql_query($query) or die(mysql_error());



	



?>



	<script language="javascript">



	alert('修改成功');



	window.location.href='updata2.php';



	</script>
 
</body>


</html>