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
	$query = sprintf("SELECT * FROM indata ORDER BY number");
	$result = mysql_query($query) or die(mysql_error());
	$totalRows = mysql_num_rows($result);
?>
<div class=out1 style='text-align:center; line-height:20px'>
<a class="new" href="./newinfo.php"  id="a"><strong>新增設備資料</strong></a>
 <?php
   function pageSplit($startPos, $rowsPerPage = '', $totalRows = '' )
        {
 
            $numPages = $totalRows / $rowsPerPage ;
            $tenthPages = $rowsPerPage * 10 ;
            If($startPos >= $tenthPages )
            {
                $back10Position = $startPos - $tenthPages ;
                $pageString .= '<a href="'.$PHP_SELF.'?startPos='.$back10Position .'&perPageDisplay='.$rowsPerPage.'" title="Previous 10 Pages"><font color="red"><< </font></a>  ';
            }
 
            if($startPos >= $rowsPerPage)
            {
                $backPosition = $startPos - $rowsPerPage;
                $pageString .= '<a href="'.$PHP_SELF.'?startPos='.$backPosition.'&perPageDisplay='.$rowsPerPage.'" title="Previous Page"><font color="blue">Back</a></font> ';
            }
                  
            if($totalRows != '')
            {
                     $page = ceil($startPos / $rowsPerPage);
                     $pageCount = $page + $numPages;
 
                    $PageNo = ceil($startPos / $rowsPerPage )  ;
                    // echo ' Page No ' . $PageNo ;
                    for($i = 1,$pgCnt=1; $page <= $pageCount; $i = $i + $rowsPerPage)
                    {
                        if ( $PageNo == $pgCnt )
                        {
                            $pageString .= ' <a href="'.$PHP_SELF.'?startPos='.$i.'&perPageDisplay='.$rowsPerPage.'" title="Page '.$pgCnt.'""><font color="red"><b>'.$pgCnt.'</b></font></a> ';
                            $pgCnt++;
                        }
                        elseif ($i < $totalRows)
                        {
                            $pageString .= ' <a href="'.$PHP_SELF.'?startPos='.$i.'&perPageDisplay='.$rowsPerPage.'" title="Page '. $pgCnt.'"">'.$pgCnt.'</a> ';
                            $pgCnt++;
                        };
                          
                        $page++;
                    };
            }
 
            $nextPosition = $startPos + $rowsPerPage;
 
            if($totalRows == '')
            {
                $pageString .= '<a href="'.$PHP_SELF.'?startPos='.$nextPosition.'&perPageDisplay='.$rowsPerPage.'" title="Next Page"><font color="blue" >Next </font></a> ';
            }
            elseif($startPos < $totalRows )
            {
                If ( $nextPosition < $totalRows )
                {
                    $pageString .= '<a href="'.$PHP_SELF.'?startPos='.$nextPosition.'&perPageDisplay='.$rowsPerPage.'" title="Next Page"><font color="blue" title="Next Page">Next </font></a>  ';
                }
            }
 
            if($startPos < $totalRows )
            {
                $next10Position = $startPos + $tenthPages ;
 
                If($next10Position < $totalRows )
                {
                    $next10Position = $startPos + $tenthPages ;
                    $pageString .= '<a href="'.$PHP_SELF.'?startPos='.$next10Position .'&perPageDisplay='.$rowsPerPage.'" title="Next 10 Pages"><font color="red"> >></font></a>';
                }
            }
                return $pageString;
        }
?>

  <table width="900"  height="80">

          <th width="130" align="center" valign="top"><div align="center">財產編號</div></th>

               <th width="120" align="center" valign="top"><div align="center">財產種類</div></th>

               <th width="150" align="center" valign="top"><div align="center">廠牌型號</div></th>

               <th width="70" align="center" valign="top"><div align="center">存置地點</div></th>

               <th width="70" align="center" valign="top"><div align="center">借用狀況</div></th>

               <th width="70" align="center" valign="top"><div align="center"></div></th>

               <?php

               while ($row = mysql_fetch_array($result))
                {
                    echo "<tr>";
					echo "<td>".$row["number"]."</td>";
                    echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["model"]."</td>";                    echo "<td>".$row["local"]."</td>";
     				echo "<td>".$row["status"]."</td>";
                    echo "<td>";

                    ?>

               <a href="./editinfo.php?number=<?php echo $row["number"]?>">

               <button>修改</button>

               </a>

               <button onClick="

                    if(confirm('是否確定要刪除？?'))

                    {                  
                      window.location.href='./deleteinfo.php?number=<?php echo $row["number"]?>';
                    }

                    "> 刪除 </button>

               <?php
                 
                    echo "</td>";
 
                    echo "</tr>";
                }

            ?>
               <p class="right"></p>
               <p class="right"></p>
           </table>
      </div>
         </div>
    <div id="top">
         
</div>

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