<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

mb_http_input("utf-8");

mb_http_output("utf-8");

?>

<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : GoodLife 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20121013

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>資管系設備出借系統</title>
<link rel="shortcut icon" href="image/favicon.ico" />
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	
	<meta http-equiv="content-language" content="en-gb" />
	<meta http-equiv="imagetoolbar" content="false" />
	<meta name="author" content="Christopher Robinson" />
	<meta name="copyright" content="Copyright (c) Christopher Robinson 2005 - 2007" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />	
	<meta name="last-modified" content="Sat, 01 Jan 2007 00:00:00 GMT" />
	<meta name="mssmarttagspreventparsing" content="true" />	
	<meta name="robots" content="index, follow, noarchive" />
	<meta name="revisit-after" content="7 days" />
<style type="text/css">
<!--
#admin .content p {
	text-align: center;
}
#admin .content table {
	text-align: center;
}
#admin .content table {
	text-align: left;
}
#wrap #admin div table {
	text-align: center;
}
#wrap #admin div table {
	text-align: center;
}
#fbox2 p {
}
-->
</style>
</head>
<body>

<div id="header-wrapper">
 <div id="header">
  <h1>資管系設備出借系統</h1>
	<h2>Equipment lending system.	 </h2>
  </div>
			<div id="navigation">
            <ul>
              <li><a href="member2.php" >借閱審核</a></td>
			  <li><a href="infoM.php">報表管理</a></li>
				<li><a href="info2.php">設備管理</a></li>
                <li><a href="updata2.php">會員資料管理</a></li>
                <li><a href="logout.php">管理者登出</a></li>
			<body> 
		  </ul>
		</div>
</div>
</div>
<div id="footer-wrapper">
<div id="footer-content">
	  <div id="fbox2">

        </head>
          <p>&nbsp;</p>
        <p>&nbsp; </p>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
<p>
  <?php
include("mysql_in.php");
   
    $query = sprintf("SELECT * FROM lend  ORDER BY bd DESC");
	$result = mysql_query($query) or die(mysql_error());
	$totalRows = mysql_num_rows($result);

?>
</p>
<div id="content">
  <h1>借閱審核
  <br />
  
  </h1></div>
<p>財產編號
    <input name="no" type="text" id="no" size="20"><br>
    <br />
    財產名稱
    <input type="text" name="name" id="name"><br>
    <br />
    廠牌型號
    <input name="model" type="text" id="model" size="20"><br>
    <br />
    存置地點
    <input type="text" name="local" id="local"><br>
    <br />

  </p>

</tr>
     <center>　　　　 
     <input type="submit" name="Submit" value="新增" />
  　
    <a href="info2.php"> <input type="submit" name="Submit2" value="取消" /> </a>
  <br />
  <br />
</form>
<div id="page-wrapper"></div>

    <div id="footer"></div>
    <p>國立臺中科技大學　<a href="https://maps.google.com.tw/maps?f=q&source=embed&hl=zh-TW&geocode=&q=%E5%9C%8B%E7%AB%8B%E8%87%BA%E4%B8%AD%E7%A7%91%E6%8A%80%E5%A4%A7%E5%AD%B8&aq=&sll=24.220103,120.955874&sspn=1.070787,2.113495&brcurrent=3,0x34693d615982862d:0xe09e5f83f830e084,0,0x346917dff97922ef:0x87523ee47ea6447f&ie=UTF8&hq=%E5%9C%8B%E7%AB%8B%E8%87%BA%E4%B8%AD%E7%A7%91%E6%8A%80%E5%A4%A7%E5%AD%B8&t=m&ll=24.150258,120.68387&spn=0.006853,0.012875&z=16">404　台中市北區三民路三段129號</a> 　│　進修部資訊管理系　<a href="http://www.work123.erufa.com">設備管理系統</a></p>
	</div>
</body>
</html>

