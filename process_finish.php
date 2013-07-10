<?php session_start(); ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php		 

include("mysql_in.php");
if($_POST["number"]==null)
{
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '請選擇型號！' );";
			echo "history.back();";
			echo "</script>";
}
else
{
	$user = $_SESSION["username"];
    $number = $_POST["number"];
	 
	$query = sprintf("SELECT * FROM indata where number='".$number."'");
	$result = mysql_query($query)or die(mysql_error());
	//$number = mysql_num_rows($result);
	
	while ($row = mysql_fetch_assoc($result)) {  
	$name= $row["name"];
	$model=$row["model"];
	}
		
	   date_default_timezone_set('Asia/Taipei');  
	   $date =date("Y-m-d"); 
	   $date5 = date('Y-m-d', time() + (5 * 24 * 60 * 60));
	    $sql = "insert into lend (user, name, model, number, NY, bd,5d) values ('$user','$name', '$model', '$number', 'N', '$date', '$date5')";
   	  	  	 
		if(mysql_query($sql))

        {
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '審核中！' );";
			echo "history.back();";
			echo "</script>";
        }

        else

        {
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '新增失敗！' );";
			echo "history.back();";
			echo "</script>";
        }
		
		 $sql = "insert into history ( user, name, model, number, bd) values ('$user','$name', '$model', '$number', '$date')";
        if(mysql_query($sql))
		
		{
               echo '';

                       }

        else

        {

                echo '';

        }
		
		 $query = sprintf("UPDATE indata SET status = '已借' WHERE number = '".$_POST['number']."'"); 
		 if(mysql_query($query))
        {
        echo '';
        
        }
		 else
        {
        echo '';
        }
		
 $query = sprintf("UPDATE indata SET NY = 'Y' WHERE number = '".$_POST['number']."'"); 
		 if(mysql_query($query))
        {
        echo '';
        
        }
		 else
        {
        echo '';
        }
		}
		
?>