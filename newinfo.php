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
</style>
</head>

<body>
	<div id="background">
		<div id="page">
			<div id="header">
				<span id="infos">
                <a href="logout.php">管理者登出</a>
                </span>
				<a href="index.html" id="logo"></a> <!-- /#logo -->
                <center>
				<ul id="navigation"> 
              <li><a href="member2.php" >借閱審核</a></li>
        	  <li><a href="return.php">設備歸還</a></li>
              <li><a href="infoM.php">報表管理</a></li>
              <li><a href="info2.php">設備管理</a></li                            ><li><a href="updata2.php">會員資料管理</a></li>
              	</ul>
              </center>	
	    </div> <!-- /#header -->
			<div id="contents">
			  <div id="main">
               <div class=out1 style='text-align:center; line-height:20px'>
  <form name="form1" method="post" action="newinfo_finish.php" enctype="multipart/form-data">
  
   <?php

	include("mysql_in.php");

    $query = sprintf("SELECT * FROM lend  ORDER BY bd DESC");

	$result = mysql_query($query) or die(mysql_error());

	$totalRows = mysql_num_rows($result);

?>

</p>

<div id="content">
<p>

    財產編號

    <input name="number" type="text" id="number" size="20"><br>

    <br />

    財產種類

    <input type="text" name="name" id="name"><br>

    <br />

    廠牌型號

    <input name="model" type="text" id="model" size="20"><br>

    <br />

    存置地點

    <input type="text" name="local" id="local">

    <? 

echo '<pre>'; 

print_r($_FLES); 

echo '</pre>'; 

move_uploaded_file($_FILES['File1']['tmp_name'], './'.$_FILES['File1']['name']); 

?>

 </p>

     <input type="submit" name="Submit" value="新增" />

　 <a href="info2.php"> <input type="submit" name="Submit2" value="取消"/> </a>

  <br />

</form>

<div id="page-wrapper"></div>

    <div id="footer"></div>

    <div id="footer"></div>

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