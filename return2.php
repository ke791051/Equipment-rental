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
</head>

<style>
#wrap{width:980px;margin:30px auto;border:1px solid #AB8F00;background:#FFF;}
#top{width:980px;height:35px; background:#FDF79A ;}
#admin{width:960px;background:#EEE;margin:10px;padding-bottom:30px;color:#666;float:left;}
#admin .title{width:960px;height:30px;text-align:center; font-size:18px; line-height:30px;background:#DDD}
#admin .content{width:960px; list-style:none;text-align:center;}
#admin .content .new{width:120px;height:30px;margin:10px auto;display:inherit;font-size:20px; line-height:30px;color:#960;padding:3px;background:#EDEDD8;border:1px solid #AB8F00;}
#admin .content .new:hover{background:#909065;color:#FFF;}
#admin .content table th{width:118px;font-size:18px; line-height:30px;height:30px;color:#960;padding:2px;background:#EDEDD8;border:1px solid #AB8F00;}
#admin .content table td{border:1px solid #AB8F00;font-size:14px;}
#admin .content li a:hover{background:#909065;color:#FFF;}
#footer{clear:both;}
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
              <li><a href="member.php" >借閱申請</a></td>
				<li><a href="return.php">借閱歸還</a></li>
				<li><a href="info.php">設備總覽</a></li>
                <li><a href="updata.php">使用者管理</a></li>
                <li><a href="logout.php">使用者登出</a></li>
			
		  </ul>
		</div>

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        
<?php

	include("mysql_in.php");
    $user = $_SESSION["user"];
	$query = sprintf("SELECT * FROM lend WHERE user = '%s'",$user);
	$result = mysql_query($query) or die(mysql_error());
	$totalRows = mysql_num_rows($result);
?>
   <div id="wrap">
	<div id="top">
    </div>
        <div id="admin">
        <div class="content">
    	<div class="title">借閱歸還</div>
            <table width="909">
            <th width="180">姓名</th>
            <th width="180">種類</th>
            <th width="180">型號</th>
            <th width="180">編碼</th>
            <th width="180">日期</th>
   <?php
                 while ($row = mysql_fetch_array($result))

                {
                    echo "<tr>";
					echo "<td>".$row["user"]."</td>";
                    echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["model"]."</td>";
                    echo "<td>".$row["no"]."</td>";
                    echo "<td>".$row["date"]."</td>";
                 }
                    ?>
             
 <br>     
  </table>        
<input type="submit" name="Submit" value="歸還" />

</div>
    </div>
    <div id="footer"></div>
</div>
</body>
</html>