<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<?php
include("mysql_in.php");

       date_default_timezone_set('Asia/Taipei');  
	   $datere =date("Y-m-d"); 
$number = $_GET["number"];
$query = sprintf("UPDATE lend SET rd = '$datere' WHERE number = '".$_GET['number']."'"); 
     mysqli_query($db, $query) or die(mysqli_error());
	 header("Location:return.php");
$query = sprintf("UPDATE history SET rd = '$datere' WHERE number = '".$_GET['number']."'"); 
		 
		 if(mysqli_query($db, $query))
        {
        echo '';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=return.php>';
        }
		 else
        {
        echo '';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=return.php>';
        }		
$number = $_GET["number"];		
$query = sprintf("UPDATE indata SET NY = '' WHERE number = '".$_GET['number']."'"); 
	 mysqli_query($db, $query) or die(mysqli_error());
	 header("Location:return.php");
		
$number = $_GET["number"];			  
$query = sprintf("UPDATE indata SET status = '' WHERE number = '".$_GET['number']."'"); 
		 
	mysqli_query($db, $query) or die(mysqli_error());
	header("Location:return.php");
		?>

</body>
</html>
