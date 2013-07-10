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
 
 <?php
include("mysql_in.php");
    require_once('Sliding.php');   
    require_once('Pager.php');  
	$query_str = 'SELECT `number`,`name` ,`model` ,`local` ,`status` from indata';

  $res =& $mdb2->query($query_str); // 執行查詢
  if (PEAR::isError($res)) 
    die("查詢發生錯誤：".$res->getMessage());

  $mdb2->setFetchMode(MDB2_FETCHMODE_ASSOC);  // 以欄位名稱為索引
  $rows = $res->fetchAll();                   // 取得所有資料
  if (PEAR::isError($rows)) 
    die("存取資料失敗：".$rows->getMessage());
  ?>
  
   <div align="center">
<p> 
<div class=out1 style='text-align:center; line-height:20px'>
   <table width="900" Height=100 >       

      <th width="130" align="center" valign="middle"><div align="center">財產編號</div></th>
         
      <th width="100" align="center" valign="middle"><div align="center">財產名稱</div></th>
          
      <th width="200" align="center" valign="middle"><div align="center">廠牌型號</div></th>
          
      <th width="50" align="center" valign="middle"><div align="center">存置地點</div></th>       

      <th width="50" align="center" valign="middle"><div align="center">備註</div></th>                 
 </p>  
  <?php
  $params = array(     // 分頁參數
      'mode'       => 'Sliding',      // 使用 Jumping 模式 
      'perPage'    => 20,              // 每頁四筆
      'itemData'   => $rows,          // 要分頁的資料存於 $rows 中
      'delta'      => 3);             // 每次列出 3 頁的連結
  $pager = & Pager::factory($params); // 建立分頁物件
  
  $links = $pager->getLinks();        // 取得連結陣列
  
  // 用 $_GET[pageID] 為參數呼叫 getPageData() 方法取得目前頁面資料
  // 第一次進入網頁時 $_GET[pageID] 沒有值, 所以會傳回第 1 頁的資料
  $data  = $pager->getPageData($_GET[pageID]); 
  
  // 用迴圈逐筆輸出本頁資料
  foreach($data as $row)                  // 每一筆資料都放在 <tr> 中
    echo '<tr><td>' . $row['number'] .  // 每一欄則放在 <td> 中
         '</td><td>' . $row['name']. '</td></tr>';
  ?>
<caption align="center">
<?php echo $links['all'];   // 輸出分頁連結 ?> 
</caption>
</table>     	
	

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