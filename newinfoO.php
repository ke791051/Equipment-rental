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
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Abel|Satisfy' rel='stylesheet' type='text/css' />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<style type="text/css">
body,td,th {
	font-family: Abel, sans-serif;
	color: #000;
	font-size: 12px;
}
h1,h2,h3,h4,h5,h6 {
	font-family: "微軟正黑體", "Arial Unicode MS";
	text-align: center;
}
</style>
</head>
<body>

<form name="form1" method="post" action="newinfo_finish.php">
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<h1>資管系設備出借系統</h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href=" http://im.nutc.edu.tw/" >資管系首頁</a></td>
				<li><a href="info.php">設備總覽</a></li>
				<li><a href="register.php">註冊</a></li>
			
		  </ul>
		</div>
	</div>
</div>
<div id="footer-wrapper">
	<div id="footer-content">
	  <div id="fbox2">
        <h1>設備新增</h1>
        <h1><span class="right">
         <center>
  <br />
  <br />
  <br />
  
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
  <td height="19" align="center"><center>
    </center>
    <br>
    
<td height="19">&nbsp;</td>

</tr>
     <center>　　　　 
     <input type="submit" name="Submit" value="新增" />
  　
    <a href="info2.php"> <input type="submit" name="Submit2" value="取消" /> </a>
  <br />
  <br />
</form>
<div id="page-wrapper"></div>
<div id="footer"></div>
</body>
</html>
