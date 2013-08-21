<?php
/**
 * Anticipate:
 *  - array $errors
 *  - array $infos
 *  - string $caption
 *  - string $postUrl
 */
?>

<h1><?php echo $caption ?></h1>

<ul>
	<?php foreach ($infos as $info): ?>
		<li><?php echo $info ?></li>
	<?php endforeach ?>
</ul>

<ul>
	<?php foreach ($errors as $error): ?>
		<li><?php echo $error ?></li>
	<?php endforeach ?>		
</ul>

<form action="<?php echo $postUrl ?>" method="post" enctype="multipart/form-data" >
	<table>
		<tbody>
			<tr>
				<td><label>設備資料Excel檔：<input type="file" name="excelfile" required /></label></td>
			</tr>
			<tr>
				<td><label><input type="checkbox" name="hastitle" />檔案是否包含標題行</label></td>
			</tr>
			<tr>
				<td><label><input type="checkbox" name="isreplace" />設備識別碼相同時，是否覆蓋現有資料</label></td>
			</tr>
			<tr>
				<td><input type="submit" value="<?php echo $caption ?>" /></td>
			</tr>
		</tbody>
	</table>
</form>