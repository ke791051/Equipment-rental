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
	text-decoration: none;
}
a:active {
	color: #FFF;
	text-decoration: none;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
</style>
</head>

<body>
	<div id="background">
		<div id="page">
			<div id="header">
				<span id="infos">
                <?php

		        include("mysql_connect.inc.php");

        	    $id = $_SESSION["id"];

                $query = sprintf("SELECT * FROM madata WHERE id = '%s'",$id);

                $result = mysql_query($query) or die(mysql_error());

			    while ($row = mysql_fetch_array($result))

                {

				?> 
             

          <?php

			$_SESSION["username"]= $row["name"];

		 echo $row["name"]?>，同學您好 !</h1>
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
			
             

<div align="center" id="a1">
<p>
</p>
  <p>

    <?php

				}

            	

            ?>
            
              <tt><a href="member.php" >筆記型電腦 </a><a href="key.php">鑰匙 </a><a href="cam.php">數位照相機 </a><a href="cam2.php">數位攝影機 </a><a href="tab.php">數位板 </a></tt></p>

  <p><tt><a href="mtv.php">行動終端載具模組 </a><a href="wri.php">讀寫器 </a><a href="webcam.php">網路攝影機 </a><a href="rec.php">錄音筆 </a><a href="tea.php">教學擴音機 </a><a href="mcp.php">行動通訊平台 </a><a href="pre.php">簡報器 </a><a href="shelf.php">立牌架子</a></tt></p>

</div>

<div id="content">

<p>&nbsp; </p>

       <?php   include("mysql_in.php");

       ?>
    
   <form name="form1" method="POST" action="process_finish.php">

      <table width="905" height="300" border="0">
           <tr>
    <th width="261" height="315" scope="row"><img src="DENPA VT-32F.jpg" width="160" height="200" alt="立牌架台" /><br />
      DENPA VT-32F<br>
    <br>
     <select name="number" onchange= "choose(this);">
    <option value="">請選擇編號</option> 
     <?php
$query = sprintf("SELECT * FROM indata where model = '金榜文具公司' AND NY = '$null'");
$result = mysql_query($query)or die(mysql_error());
$number = mysql_num_rows($result);

while ($row = mysql_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }
?>   </select>

   <input type="submit" name="Submit" value=" 申請 " />

    </th>
    </form>
    <th width="262" scope="row"><br />
      <br>
    <br></th>
    <th width="264" scope="row"><br />
      <br>
    <br></th>
  </tr>
 
</table>
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