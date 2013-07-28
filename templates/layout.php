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
        <?php
            foreach ($addScripts as $addScript):
                echo $addScript;
            endforeach;
        ?>
    </head>
    <body>
        <div id="header">
        </div>
        <div id="nav">
            <?php include_once $navContentPath ?>
        </div>
        <div id="content">
            <?php include_once $contentPath ?>
        </div>
        <div id="footer">
        </div>
    </body>
</html>