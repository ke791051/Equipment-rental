<?php session_start(); ?>







<!--上方語法為啟用session，此語法要放在網頁最前方-->







<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<body bgcolor="ｂｌａｃｋ">



<?php

if(include("db_conn.php"))

$id = $_POST['id'];

$pw = $_POST['pw'];

$sql = "SELECT * FROM madata WHERE id = '".$id."'";

$result = mysql_query($sql);

$row = @mysql_fetch_array($result);

//以及MySQL資料庫裡是否有這個會員

if($id != null && $pw != null && $row['id'] == $id && $row['pw'] == $pw)

{           $_SESSION['id'] = $id;

            $_SESSION['name'] = $name;

            if ($row["NY"]=="未開通")
            {
			echo '您的帳號尚未開通!';
		    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
			}
             if ($row["Permission"]=="SuperAdmin")
        {
			$_SESSION['id'] = $id;

            $_SESSION['name'] = $name;

                echo '登入成功!';

                echo '<meta http-equiv=REFRESH CONTENT=2;url=member2.php>';

        }

        else

        {

			$_SESSION['id'] = $id;

            $_SESSION['name'] = $name;

                echo '登入成功!';

                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';

        }

}

 else
        {
			echo "<meta charset = 'UTF-8'>";
			echo "<script>";
			echo "alert( '帳號或密碼錯誤！' );";
			echo "history.back();";
			echo "</script>";
}



?>