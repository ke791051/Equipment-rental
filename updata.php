<?php session_start(); ?>

<!DOCTYPE html>

<?php

mb_http_input("utf-8");

mb_http_output("utf-8");

?>

<!-- Website template by freewebsitetemplates.com -->

<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>資訊管理系設備出借系統</title>

	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />	

<style type="text/css">

a:hover {

	color: #CCC;

}

a:active {

	color: #FFF;

}
out1   {width:160px;
         border:solid 1px red;
         height:100px;
        }


</style>

</head>



<body>

	<div id="background">

		<div id="page">

			<div id="header">

				<span id="infos">

                </span>

				<a href="index.html" id="logo"></a> <!-- /#logo -->

                <center>

				<ul id="navigation"> 

              <li><a href="member.php" >借閱申請</a></li>

			  <li><a href="info.php">設備總覽</a></li>

              <li><a href="updata.php">使用者管理</a></li>

              <li><a href="logout.php">使用者登出</a></li>

				</ul>

              </center>	

	    </div> <!-- /#header -->

			<div id="contents">

			  <div id="main">

<div class=out1 style='text-align:center;line-height:20px'>
 <?php

              include("mysql_connect.inc.php");

			    $id = $_SESSION["id"];

                $query = sprintf("SELECT * FROM madata WHERE id = '%s'",$id);

                $result = mysqli_query($db, $query) or die(mysqli_error());

                while ($row = mysqli_fetch_array($result))

                {

                         ?>				

  <form action="updata1.php?id=<?php echo $id?>" method="post">
  <div id="font_style">
      <table align="center">
        <tr>
          <td width="150">帳 號 ：</td>  
          <td class="data" alig><?php echo $row["id"]?></td>
		</tr>
        <tr> 
	      <td width="150">姓 名 ：</td>
          <td class="data"><input type="text" id="name" name="name" value="<?php echo $row["name"]?>" /></td>
		</tr>
        <tr>
          <td width="150">密 碼 ：</td>
          <td class="data"><input type="password" id="pw" name="pw" value="<?php echo $row["pw"]?>" /></td>
        </tr>
        <tr>
          <td width="150">確 認 密 碼 ：</td>
          <td class="data"><input type="password" id="pw2" name="pw2" value="<?php echo $row["pw2"]?>" /></td>
        </tr>
        <tr>
          <td width="150">學 制 ：</td>
          <td class="data"><input type="text" id="sy" name="sy" value="<?php echo $row["sy"]?>" /></td>
        </tr>
        <tr>
          <td width="150">E-mail ：</td>
          <td class="data"><input type="text" id="mail" name="mail" value="<?php echo $row["mail"]?>" /></td>
        </tr>
        <tr>
          <td width="150">手 機 ：</td>
          <td class="data"><input type="text" id="phone" name="phone" value="<?php echo $row["phone"]?>" /></td>
        </tr>
       </table>
<input type="submit" value=" 送 出 "/>
</div>
</form>

<?php

				}

?>

</div>



     </form>



    </div>

  </div>

		  <!-- /#contents -->

			<div id="footer">

				<div id="description">

					<div>

						<a href="index.html" class="logo"></a>

<span>&copy; Copyright &copy; 2013. <a href="index.html">Company name</a> All rights reserved</span>

					</div>

					<p>透過本系統，不僅可以縮短查詢資料的時間，使用者與管理者對於設備出借狀況一目了然，再透過電腦key in借用資料，省去人工對於傳統出借單不知如何寫起與漏寫的種種問題；再者，一本又一本的出借單究竟是要留著還是丟掉?實在是令人頭疼，因此開發此系統，已達到數位化管理。

              歡迎使用本系統!! </div>

				<div class="navigation">

					<a href="index.html">系統簡介</a>|

					<a href="http://www.nutc.edu.tw">臺中科技大學</a>|

					<a href="http://im.nutc.edu.tw">資訊管理系</a>|

					<a href="register.php">註冊會員</a>|

					

				</div>

</div> <!-- /#footer -->

		</div> <!-- /#page -->

	</div> <!-- /#background -->

</body>

</html>