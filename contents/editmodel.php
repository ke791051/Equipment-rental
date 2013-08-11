<?php
/**
 *  anticipate:
 *    - array $modelData key為對應的資料庫欄位名稱
 *    - string $submitValue '新增設備型號'、'更新設備型號'等等之類的值
 *    - string $postUrl
 *    - string $postDeleteImageUrl
 *    - array|NULL $image array('id' => imageDatabaseId, 'name' => imageName, 'path' => imagePath)
 *    - array $errors
 *    - array $infos
 *    - array $categories 符合Model回傳資料規範
 *	  - string|NULL $redirectUrl
 *   
 */
?>
<div>
	<ul>
		<?php foreach($errors as $error): ?>
			<li><?php echo $error ?></li>
		<?php endforeach ?>
	</ul>
</div>

<div>
	<ul>
		<?php foreach($infos as $info): ?>
			<li><?php echo $info ?></li>
		<?php endforeach ?>
	</ul>
</div>

<form action="<?php echo $postUrl ?>" method="post" enctype="multipart/form-data" />
	<?php if (!is_null($redirectUrl)): ?>
		<input type="hidden" name="redirecturl" value="<?php echo $redirectUrl ?>" />
	<?php endif ?>
	<input type="hidden" name="id" value="<?php echo $modelData['id'] ?>" />
    <table>
    	<caption><?php echo $submitValue ?></caption>
		<tr>
			<td><label>設備型號：<input type="text" name="model" value="<?php echo $modelData['model']?>" /></label></td>
			<td>
				<label>
					設備種類：
					<select name="category_id" required>
						<option value="">請選擇設備種類</option>
						<?php foreach($categories as $category): ?>
							<option value="<?php echo $category['id'] ?>" <?php echo $modelData['category_id'] == $category['id'] ? 'selected' : '' ?>><?php echo $category['name'] ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</td>
			<td>設備圖片:<input type="file" name="image" /></td>
			<td><input type="submit" value="<?php echo $submitValue?>"></td>
		</tr>
	</table>
</form>

<!-- Delete Image Form -->
<?php if (!is_null($image)): ?>
<form action="<?php echo $postDeleteImageUrl ?>" method="post" >
	<input type="hidden" name="id" value="<?php echo $modelData['id'] ?>" />
	<?php if (!is_null($redirectUrl)): ?>
		<input type="hidden" name ="redirecturl" value="<?php echo $redirectUrl ?>" />
	<?php endif ?>
	<table>
		<tr>
			<td>
				<img src="<?php echo $image['path'] ?>" alt="<?php echo $image['name'] ?>" />
				<input type="hidden" name="delete_image_id" value="<?php echo $image['id'] ?>" />
				<input type="submit" value="刪除圖片" />
			</td>
		</tr>
    </table>
</form>
<?php endif ?>

<?php if(!is_null($redirectUrl)): ?>
	<a href="<?php echo $redirectUrl ?>">返回</a>
<?php endif ?>
