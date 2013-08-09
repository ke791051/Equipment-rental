<?php
/**
 * Anticipate:
 *   - array $modelData key為資料庫對應的欄位名稱
 *   - string $submitValue
 *   - string $postUrl
 *   - array $errors
 *   - array $infos
 *   - string $redirectUrl
 */
?>

<div>
	<ul>
		<?php foreach ($errors as $error): ?>
			<li><?php echo $error ?></li>
		<?php endforeach ?> 
	</ul>
</div>

<div>
	<ul>
		<?php foreach ($infos as $info): ?>
			<li><?php echo $info ?></li>
		<?php endforeach ?> 
	</ul>
</div>

<form action="<?php echo $postUrl ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $modelData['id'] ?>" />
	<?php if (!is_null($redirectUrl)): ?>
		<input type="hidden" name="redirecturl" value="<?php echo $redirectUrl ?>" />
	<?php endif ?>
    <table>
	    <caption><?php echo $submitValue ?></caption>
		<tr>
			<td><label>分類名稱：<input type="text" name="name" value="<?php echo $modelData['name'] ?>"/></label></td>
			<td><input type="submit" value="<?php echo $submitValue ?>" /></td>
		</tr>
    </table>
</form>

<?php if (!is_null($redirectUrl)): ?>
	<a href="<?php echo $redirectUrl ?>">返回</a>
<?php endif ?>