<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>

</head>

<body>
<form name="form1" method="post" action="process.php">

<select name="name" onChange= "choose(this);">
<option value="">請選擇預借物品種類</option>
<?
include("mysql_in.php");
$query = sprintf("SELECT  * FROM indata GROUP BY name");
$result = mysql_query($query)or die(mysql_error());
$no1= mysql_num_rows($result);

while ($row = mysql_fetch_assoc($result)) {    echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>' . "\n";    }?></select>

<select name="model" onChange= "choose(this);">
<option value="">請選擇型號</option>
<?
$query = sprintf("SELECT * FROM indata ");
$result = mysql_query($query)or die(mysql_error());
$no2 = mysql_num_rows($result);

while ($row = mysql_fetch_assoc($result)) {    echo '<option value="' . $row["model"] . '">' . $row["model"] . '</option>' . "\n";    }?></select>

<select name="no" onChange= "choose(this);">
<option value="">請選擇編號</option>
<?
$query = sprintf("SELECT * FROM indata");
$result = mysql_query($query)or die(mysql_error());
$no3 = mysql_num_rows($result);

while ($row = mysql_fetch_assoc($result)) {    echo '<option value="' . $row["no"] . '">' . $row["no"] . '</option>' . "\n";    }?></select>
<br>
<br>
<input type="submit" name="Submit" value="申請" />

<input type="reset" name="clear" value="清除" />
</form>
</body>
</html>