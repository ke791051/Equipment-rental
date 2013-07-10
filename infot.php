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
<script language="JavaScript">
function SelectIt(){
        if (document.Links.Select.options[document.Links.Select.selectedIndex].value != "none"){ 
        location = document.Links.Select.options[document.Links.Select.selectedIndex].value}        
}
</script>
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

//計算總筆數
$str="select count(*) FROM indata";
$list =mysql_query($str,$link);
list($count) = mysql_fetch_row($list);
//抓取頁數與設定分頁
$read_num="20";  //每頁讀取幾筆資料出來
$all_page=ceil($count/$read_num);//計算總頁數
if( empty($page_num) )$page_num="1";
$start_num=$read_num*($page_num-1);
$pageselt[$page_num]="selected";
?>

<form name="Links" style="font-size: 9pt">   
     <select NAME="Select" onchange="SelectIt()" size="1">
     <option value="none">請選擇</option>
<?
for($i=1;$i<=$all_page;$i++)
{ echo "     <option value=\"infot.php?page_num=$i\" $pageselt[$i]>第".$i."頁</option>"; }
?>
</select>
    
     
      

<div class="content">
<div class=out1 style='text-align:center; line-height:20px'>

      <table width="900" Height=100 >       

      <th width="130" align="center" valign="middle"><div align="center">財產編號</div></th>
         
      <th width="100" align="center" valign="middle"><div align="center">財產名稱</div></th>
          
      <th width="200" align="center" valign="middle"><div align="center">廠牌型號</div></th>
          
      <th width="50" align="center" valign="middle"><div align="center">存置地點</div></th>       

      <th width="50" align="center" valign="middle"><div align="center">備註</div></th>                 
     
 
       		  <?php
$query = sprintf ("select 'number','name','model','local','status' from indata limit $start_num,$read_num");
               
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