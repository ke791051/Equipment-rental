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
        <div align="" id="a1">
          <p>
          <?php

		        include("mysql_connect.inc.php");

        	    $id = $_SESSION["id"];

                $query = sprintf("SELECT * FROM madata WHERE id = '%s'",$id);

                $result = mysqli_query($db, $query) or die(mysqli_error());

			    while ($row = mysqli_fetch_array($result))

                {

				?> 
            
            <?php

			$_SESSION["username"]= $row["name"];

		 echo $row["name"]?>
            ，同學您好 !</h1>
          </p>
</div>
</span>
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

    <table width="950" height="1206" border="0">

           <tr>

    <th width="261" height="315" scope="row"><img src="HP-ProBook-4430s-01.jpg" alt="HPProBook 4430s" width="250" height="200" /><br />HPProBook 4430s 

    <br>

    <br>

    <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "HPProBook 4430s";	  

$query = sprintf("SELECT * FROM indata where model = 'HPProBook 4430s' AND NY = '$null'");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)) {    

echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>  </select>

   <input type="submit" name="Submit_buttom" value=" 申請 " />

    </th>

   	</form>

    <form name="form1" method="POST" action="process_finish.php">

 

    <th width="262" scope="row"><img src="IBM-T61.jpg" alt="IBM-T61" width="250" height="200"  /><br />IBM-T61

      <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "IBM-T61";	

$query = sprintf("SELECT * FROM indata where model = 'IBM-T61' AND NY = '$null'");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    

echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit_buttom" value=" 申請 " />

      </th>

   	</form>

    <form name="form1" method="POST" action="process_finish.php">

    <th width="261" scope="row"><img src="FUJITSU-S6410.jpg" alt="FUJITSU-S6410" width="250" height="200"   /><br />FUJITSU-S6410

    <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "FUJITSU-S6410";	

$query = sprintf("SELECT * FROM indata where model = 'FUJITSU-S6410' AND NY = '$null' ");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />

    </th>

   	</form>

    <form name="form1" method="POST" action="process_finish.php">

  </tr>

  <tr>

    <th  height="288" scope="row"><img src="ASUS-EeePC-1015PX.jpg" width="250" height="200" alt="EeePC" /><br />ASUS-EeePC

    <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "ASUS-EeePC";	

$query = sprintf("SELECT * FROM indata where model = 'ASUS-EeePC-1015PX-3CELL版' AND NY = '$null' ");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />

    </th>

   	</form>

    <form name="form1" method="POST" action="process_finish.php">

    <th width="262" scope="row"><img src="ASUS-904HP.jpg" width="250" height="200" alt="904" /><br />ASUS-904HP-8點9吋

 <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "ASUS-904HP-8點9吋";	

$query = sprintf("SELECT * FROM indata where model = 'ASUS-904HP-8點9吋' AND NY = '$null' ");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />

</td>

	</form>

    <form name="form1" method="POST" action="process_finish.php">

    <th width="262" scope="row"><img src="ASUS-M2C.jpg" width="250" height="200" alt="M2C" /><br />ASUS-M2C

 <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "ASUS-M2C";	

$query = sprintf("SELECT * FROM indata where model = 'ASUS-M2C' AND NY = '$null' ");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />  

</td>

	</form>

    <form name="form1" method="POST" action="process_finish.php">

    <tr>

    <th height="302" scope="row"><img src="ASUS-TE101.jpg" width="250" height="200" alt="TE101" /><br />ASUS-TE101-10吋螢幕

 <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "ASUS-TE101-10吋螢幕";	

$query = sprintf("SELECT * FROM indata where model = 'ASUS-TE101-10吋螢幕' AND NY = '$null' ");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />

    </th>

    </form>

    <form name="form1" method="POST" action="process_finish.php">

    <th width="262" scope="row"><img src="HTC-Touch-Pro.jpg" width="250" height="200" alt="PRO" /><br />HTC-Touch-Pro

 <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "HTC-Touch-Pro";	

$query = sprintf("SELECT * FROM indata where model = 'HTC-Touch-Pro' AND NY = '$null' ");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />

    </th>

</td>

	</form>

    <form name="form1" method="POST" action="process_finish.php">

    <th width="262" scope="row"><img src="HP iPAQ 212 Enterprise Handheld.jpg" width="250" height="200" alt="212" /><br />HP-Ipaq212

 <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

 <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "HP-Ipaq212";	

$query = sprintf("SELECT * FROM indata where model = 'HP-Ipaq212' AND NY = '$null' ");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />



    </th>

</td>

  </tr>

  	</form>

    <form name="form1" method="POST" action="process_finish.php">

   <tr>

    <th height="289" scope="row"><img src="ASUS-1215B.jpg" width="250" height="200" alt="1215" /><br />ASUS-1215B-11點6吋螢幕

  <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "ASUS-1215B-11點6吋螢幕";	

$query = sprintf("SELECT * FROM indata where model = 'ASUS-1215B-11點6吋螢幕' AND NY = '$null' ");

$result = mysqli_query($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />

    </th>  

    </form>

    <form name="form1" method="POST" action="process_finish.php">

    <th width="262" scope="row"><img src="MacBook-Pro-13.jpg" width="250" height="200" alt="mac" /><br />MacBook-Pro-13吋

 <br>

    <br>

     <select name="number" onchange= "choose(this);">

    <option value="">請選擇編號</option> 

     <?php

$_SESSION["name"] = "筆記型電腦";

$_SESSION["model"] = "MacBook-Pro-13吋";	

$query = sprintf("SELECT * FROM indata where model = 'MacBook-Pro-13吋' AND NY = '$null' ");

$result = mysql_queryi($db, $query)or die(mysqli_error());

$number = mysqli_num_rows($result);



while ($row = mysqli_fetch_assoc($result)) {    echo '<option value="' . $row["number"] . '">' . $row["number"] . '</option>' . "\n";    }

?>   </select>

 <input type="submit" name="Submit" value=" 申請 " />



</td>

</form>

    <td><br /></td>

  </tr>

</table>

          </p>    

       </form>
 
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