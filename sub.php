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
	
	 $query = sprintf("UPDATE lend SET NY = 'Y' WHERE number = '".$_GET['number']."'"); 
		 if(mysqli_query($db, $query))
        {
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '處理中！' );";
			echo "history.back();";
			echo "</script>";
        }
		 else
        {
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '處理失敗！' );";
			echo "history.back();";
			echo "</script>";
        }

?>
</body>
</html>