<?php
/**
 * anticipate:
 *  - array $modelData
 *  - string $submitValue
 *  - string $postUrl
 *  - array $models
 *  - array $statues array('code' => int, 'message' => string)
 *  - array $errors
 *  - array $infos
 *  - string|NULL $redirectUrl
 */
?>

<h1><?php echo $submitValue ?></h1>

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

<form action="<?php echo $postUrl ?>" method="post">
	<?php if(!is_null($redirectUrl)): ?>
		<input type="hidden" name="redirecturl" value="<?php echo $redirectUrl ?>" />
	<?php endif ?>
	<input type="hidden" name="id" value="<?php echo $modelData['id'] ?>" />
	<ol>
		<li>
			<label>設備識別碼：<input type="text" name="identify" value="<?php echo $modelData['identify'] ?>" /></label>
		</li>
		<li>
			<label>設備地點：<input type="text" name="location" value="<?php echo $modelData['location'] ?>" /></label>
		</li>
		<li>
			<label>設備狀態：
				<select required name="status">
					<option value="">請選擇設備狀態</option>
					<?php foreach ($statues as $status): ?>
						<option value="<?php echo $status['code'] ?>" <?php echo $modelData['status'] === $status['code'] ? 'selected' : '' ?>><?php echo $status['message'] ?></option>
					<?php endforeach ?>
				</select>
			</label>
		</li>
		<li>
			<label>
				設備型號：
				<select name="model_id" required>
					<option value="">請選擇設備型號</option>
					<?php foreach($models as $model): ?>
						<option value="<?php echo $model['id'] ?>" <?php echo $modelData['model_id'] == $model['id'] ? 'selected' : '' ?>><?php echo $model['model'] ?></option>
					<?php endforeach ?>
				</select>
			</label>
		</li>
		<li>
			<label>備註：<textarea name="note"><?php echo $modelData['note'] ?></textarea></label>
		</li>
		<li>
			<label>預計報廢時間：<input type="date" name="duedate" value="<?php echo $modelData['duedate'] ?>" /></label>
		</li>
		<li>
			<input type="submit" value="<?php echo $submitValue ?>" />
		</li>
	</ol>
</form>

<?php if(!is_null($redirectUrl)): ?>
	<a href="<?php echo $redirectUrl ?>">返回</a>
<?php endif ?>
