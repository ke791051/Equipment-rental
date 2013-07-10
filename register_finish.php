<?php session_start(); ?>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<?php



include("mysql_connect.inc.php");



$name = $_POST['name'];



$id = $_POST['id'];



$pw = $_POST['pw'];



$pw2 = $_POST['pw2'];



$phone = $_POST['phone'];



$sy = $_POST['sy'];



$mail = $_POST['mail'];







//判斷帳號密碼是否為空值



//確認密碼輸入的正確性



if($id != null && $pw != null && $pw2 != null && $pw == $pw2)
{
        //新增資料進資料庫語法
        $sql = "insert into madata (name, id, sy, phone, mail, pw, pw2, Permission, NY) values ('$name','$id', '$sy', '$phone', '$mail', '$pw', '$pw2', 'user', '未開通')";



        if(mysqli_query($db, $sql))



        {
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
        }
        else
        {
                 echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '您入的資料有誤' );";
			echo "history.back();";
			echo "</script>";
        }
}
else
{
  echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '您入的資料有誤' );";
			echo "history.back();";
			echo "</script>";
}



?>