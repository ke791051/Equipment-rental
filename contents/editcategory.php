<?php
/**
 * Anticipate:
 *   - array $modelData key為資料庫對應的欄位名稱
 *   - string $submitValue
 *   - string $postUrl
 *   - array $errors
 *   - array $infos
 */
?>
<h1><?php echo $submitValue ?></h1>
<ul>
	<?php foreach ($errors as $error): ?>
		<li><?php echo $error ?></li>
	<?php endforeach ?> 
</ul>
<ul>
	<?php foreach ($infos as $info): ?>
		<li><?php echo $info ?></li>
	<?php endforeach ?> 
</ul>
<form action="<?php echo $postUrl ?>" method="post">
	<ol>
		<li><label>分類名稱：<input type="text" name="name" value="<?php echo $modelData['name'] ?>"/></label></li>
		<li><input type="submit" value="<?php echo $submitValue ?>" /></li>
	</ol>
</form>
