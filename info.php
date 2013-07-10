<?php session_start(); ?>
<!DOCTYPE html>
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
<div class=out1 style='text-align:center; line-height:20px'>
				
<?php
include("mysql_in.php");

	$query = sprintf("SELECT * FROM indata ORDER BY number");

	$result = mysqli_query($db, $query) or die(mysql_error());

	$totalRows = mysqli_num_rows($result);
?>      
         
         </div>

<div class="content">
<div class=out1 style='text-align:center; line-height:20px'>

      <table width="900" Height=100 >       

      <th width="130" align="center" valign="middle"><div align="center">財產編號</div></th>
         
      <th width="100" align="center" valign="middle"><div align="center">財產種類</div></th>
          
      <th width="200" align="center" valign="middle"><div align="center">廠牌型號</div></th>
          
      <th width="50" align="center" valign="middle"><div align="center">存置地點</div></th>       

      <th width="50" align="center" valign="middle"><div align="center">備註</div></th>                 
 </p>       

        <div class=out1 style='text-align:center; line-height:20px'>

          
		  <?php
		  
                while ($row = mysqli_fetch_array($result))
                { 
                    echo "<tr>";
					echo "<td>".$row["number"]."</td>";
                    echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["model"]."</td>";
                    echo "<td>".$row["local"]."</td>";
   				    echo "<td>".$row["status"]."</td>";
				}
				    ?>          
          
        </table>    
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