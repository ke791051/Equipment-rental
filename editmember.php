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
include("mysql_connect.inc.php");
$query = sprintf("SELECT * FROM madata ORDER BY id");
$result = mysql_query($query) or die(mysql_error());
$totalRows = mysql_num_rows($result);
?>
<?php
include("mysql_connect.inc.php");
$id = $_GET["id"];
$query = sprintf("SELECT * FROM madata WHERE id = '%s'",$id);
$result = mysql_query($query) or die(mysql_error());
                while ($row = mysql_fetch_array($result))
               {
                    ?>
 <div class=out1 style='text-align:center; line-height:20px'>           
         </div>
            <form action="editmember1.php?id=<?php echo $id?>" method="post">
              
               <div align="center">

                 <table width="254" height="167">
                  
                   <tr>
                                                         
                   <td width="54">帳號</td>
                     
                   <td width="188" class="data"><div align="left">

                      <?php echo $row["id"]?> 

                     </div></td>
                    
                     <tr>
                       
                     </tr> <td>姓名</td>
                         
                     <td class="data"><div align="left">

                           <input type="text" id="name" name="name" value="<?php echo $row["name"]?>" />

                         </div></td>
                        
                                           
                     <tr>
                        
                     <td>學制</td>
                     
                     <td class="data"><div align="left">

                       <input type="text" id="sy" name="sy" value="<?php echo $row["sy"]?>" />

                     </div></td>
                    
                     </tr>
                   
                     <tr>
                 
                     <td>E-mail</td>
                      
                     <td class="data"><div align="left">

                       <input type="text" id="mail" name="mail" value="<?php echo $row["mail"]?>" />

                     </div></td>
                  
                     </tr>
                  
                     <tr>
                     
                     <td>手機</td>
                     
                     <td class="data"><div align="left">

                       <input type="text" id="phone" name="phone" value="<?php echo $row["phone"]?>" />

                     </div></td>
                   
                     </tr>
                
                     <tr>
                    
                     <td>權限</td>
               
                     <td class="data">                    

                       <div align="left">

                         <select name="Permission">                          
                           <?php 

                   if ($row["Permission"]=="user")
                                            {
            echo "<option selected value =\"user\">一般使用者</option>";
                                            }

               else

                                            {

            echo "<option value =\"user\">一般使用者</option>";
                                            }
                                                        
                   if ($row["Permission"]=="SuperAdmin")

                                           {
             echo "<option selected value =\"SuperAdmin\">最高管理者</option>";
                                            }
                else

                                            {

             echo "<option value =\"SuperAdmin\">最高管理者</option>";
                                           }
                                     ?>
                          
                         </select>                       

                       </div></td>
                     
                     </tr>   
                  
                  <tr>
                    
                      <td>狀態</td>
               
                     <td class="data">                    

                       <div align="left">

                         <select name="NY">                          
                           <?php 

                   if ($row["NY"]=="未開通")
                                            {
            echo "<option selected value =\"未開通\">未開通</option>";
                                            }

               else

                                            {

            echo "<option value =\"未開通\">未開通</option>";
                                            }
                                                        
                   if ($row["NY"]=="已開通")

                                           {
             echo "<option selected value =\"已開通\">已開通</option>";
                                            }
                else

   {

             echo "<option value =\"已開通\">已開通</option>";
                                           }
                                     ?>
                          
                         </select>                              

                       </div></td>
                     
                  
                   <tr>
                   
                   </table>
             
                 <p>
                   <input type="submit" value="送出"/>
                 </p>
               </div>
   </form>
                    <?php
                }

           ?>

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