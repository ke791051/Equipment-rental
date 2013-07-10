<?php session_start(); ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

include("mysql_in.php");



	$number = $_POST['number'];

	$name = $_POST['name'];

	$model =$_POST['model'];

	$local = $_POST['local'];
	 
        

			
		$sql = "INSERT INTO indata (number, name, model, local) VALUES ('$number', '$name','$model','$local')";

				
		if($number!= null && $name!= null && $model!= null && $local!= null )
		{
        if(mysqli_query($db, $sql))
        {
			header("Location:info2.php");
			exit;
        }



        else
        {
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '新增失敗！' );";
			echo "history.back();";
			echo "</script>";
        }
		}
		else
		{
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '請確定所有欄位皆已輸入！' );";
			echo "history.back();";
			echo "</script>";
		}


				

				

			



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>無標題文件</title>

</head>



<body>

</body>

</html>