<?php session_start(); ?>
<html> 
<title> 
</title> 
<body> 
<form name="form1"> 
<?php
           include("mysql_connect.inc.php");
		   $id = $_SESSION["id"];
           $query = sprintf("SELECT * FROM madata WHERE id = '%s'",$id);
           $result = mysql_query($query) or die(mysql_error()); 
 while ($row = mysql_fetch_array($result))

                {

                    ?>

                    <form action="updata1.php?id=<?php echo $id?>" method="post">

                        <table>

</form> 
<table width="200" border="1">
   <tr>
    <th scope="col">姓名</th>
    <th scope="col"><?php 
echo $row["name"]
?></th>
  </tr>
  <tr>
    <th scope="col">種類</th>
    <th scope="col"><?php 
$name = $_POST["name"]; 
echo "" . $_POST["name"]; 
?></th>
  </tr>
  <tr>
   <th scope="col">型號</th>
    <th scope="col"><?php 
$model = $_POST["model"]; 
echo "" . $_POST["model"]; 
?> </th>
  </tr>
  <tr>
    <th scope="col">編號</th>
    <th scope="col"><?php 
	$no = $_POST["no"]; 
echo "" . $_POST["no"]; 
				}
 ?>
 
  </tr>
</table>

<br>
<br>

<form name="form2" form action="process_finish.php" method="post">
<input type="submit" name="Submit" value="通過" />

<input type="reset" name="clear" value="駁回" />
</form> 
</body> 
</html>