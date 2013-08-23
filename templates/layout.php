<?php
/**
 * Anticipate:
 *  - string $title 網頁的標題
 *  - string $navContentPath 包含導覽列內容的路徑
 *  - string $contentPath 網頁內容的路徑
 *  - array $addScripts 額外要掛載的腳本完整載入語法
 */
?>

<html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $title ?></title>
        <script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/reset.css" type="text/css" charset="utf-8" />
    	<link rel="stylesheet" href="css/layout.css" type="text/css" charset="utf-8" />
        <script src="jquery/layout.js" type="text/javascript"></script>
        <?php
            foreach ($addScripts as $addScript):
                echo $addScript;
            endforeach;
        ?>
    </head>
    <body>
    	<div id="login">
			<?php 
                if(!isset($_SESSION['user_id']))
                    {
                    ?>	
                        <div id="login_form" ></div>
                        <input type="button" id="login_Add" value="Login">     
                    <?php
                    }
            ?>
        </div>
    	<div id="page">
	        <div id="header">
	        		<span id="infos">
	
	                <img src="images/User Anonymous Yellow Regular_256.png" height="24.3px" width="18.6px"><a href="logout.php"><?php 
                	if(!isset($_SESSION['user_id']))
                    {
                    ?>使用者尚未登入
            <?php
                    }
					else {
						echo '使用者 '. $_SESSION['user_id'] . ' 按此登出';
					}
            ?></a>
	
					</span>
	
					<a href="index.php" id="logo"></a> <!-- /#logo -->
	
	                <center>
	
					<ul id="navigation"> 
	
						<?php include_once $navContentPath ?>	
	
					</ul>
	        </div> <!-- /#header -->
	        
	        <div id="content">
	        	<div id="main">
	            	<?php include_once $contentPath ?>
	            </div>
	        </div>
	        
			<div id="footer">
				<div id="description">
					<div id="Copyright">
						<a href="index.html" class="logo"></a>
						<span>&copy; Copyright &copy; 2013. <a href="index.html">Company name</a>All rights reserved</span>
					</div>
					<div id="summary">
                        <p>透過本系統，不僅可以縮短查詢資料的時間，使用者與管理者對於設備出借狀況一目了然，再透過電腦key in借用資料，省去人工對於傳統出借單不知如何寫起與漏寫的種種問題；再者，一本又一本的出借單究竟是要留著還是丟掉?實在是令人頭疼，因此開發此系統，以達到數位化管理。
    
                  歡迎使用本系統!! </p>
              		</div>
				</div>
				<div class="navigation">
                	<ul>
                    	<li>
                        	<a href="index.html">系統簡介</a>
                        </li>
                        <li>
                        	<a href="http://www.nutc.edu.tw">臺中科技大學</a>
                        </li>
                        <li>
                        	<a href="http://im.nutc.edu.tw">資訊管理系</a>
                        </li>
                        <li>
                        	<a href="register.php">註冊會員</a>
                        </li>
                    </ul>
                </div>
			</div> <!-- /#footer -->
        </div> <!-- /#page -->
    </body>
</html>