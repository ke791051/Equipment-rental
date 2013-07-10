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
                <img src="images/User Anonymous Yellow Regular_256.png" height="24.3px" width="18.6px"><a href="index.php">系統管理員及會員登入</a>
				</span>
				<a href="index.html" id="logo"></a> <!-- /#logo -->
                <center>
				<ul id="navigation"> 
                	<li><a href="index.html">系統簡介</a></li>               
				  <li><a href="http://www.nutc.edu.tw">臺中科技大學</a></li>
					<li><a href="http://im.nutc.edu.tw">資訊管理系</a></li>
                    <li><a href="register.php">註冊會員</a></li>			
				</ul>
              </center>	
	    </div> <!-- /#header -->
			
            <div id="contents">
			
              <div id="main">
				
               <form name="form1" method="post" action="register_finish.php">
<div class=out1 style='text-align:center; line-height:20px'>
<div id="main p b">

<p>學　　制 ：

    <select name="sy" id="sy">

      <option value="二技" >二技</option>

      <option value="四技" >四技</option>

      <option value="五專" >五專</option>

    </select>

</p>

<p>姓　　 名：

<input name="name" type="text" id="name"/><br>

<br />
    
學號/員編：

<input type="text" name="id" id="id"/><br>

<br />

E - m a i l   ：

<input name="mail" type="text" id="mail"/><br>

<br />

電　　 話：

<input type="text" name="phone" id="phone"/><br>

<br />

密　　 碼：

<input type="password" name="pw" id="pw"/><br>

<br />

確 認 密 碼：

<input name="pw2" type="password" id="pw2"/></p>

  <td height="19" align="center"><center>

</center>

  <td height="19">&nbsp;</td>

 <input type="submit" name="Submit" value="註冊" /> 

                    
   <input type="reset" name="Submit2" value="取消" /> 
 
<p>
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