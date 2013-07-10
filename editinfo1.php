<?php session_start(); ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

include("mysql_in.php");

    $number = $_POST["number"];

	$name = $_POST["name"];

	$model = $_POST["model"];

	$local = $_POST["local"];	

	$query = sprintf("UPDATE indata SET number ='%s', name = '%s', model = '%s',  local = '%s' WHERE number = '%s'", $number, $name, $model,  $local, $number);

	mysql_query($query) or die(mysql_error());

	

?>

	<script language="javascript">

	alert('修改成功');

	window.location.href='info2.php';

	</script>

    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>無標題文件</title>

</head>



<body>

</body>

</html>