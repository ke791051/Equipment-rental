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

<div>
	<ul>
		<?php foreach ($infos as $info): ?>
			<li><?php echo $info ?></li>
		<?php endforeach ?>
	</ul>
</div>

<div>
	<ul>
		<?php foreach ($errors as $error): ?>
			<li><?php echo $error ?></li>
		<?php endforeach ?>
	</ul>
</div>

<form action="<?php echo $postUrl ?>" method="post">
	<?php if(!is_null($redirectUrl)): ?>
		<input type="hidden" name="redirecturl" value="<?php echo $redirectUrl ?>" />
	<?php endif ?>
	<input type="hidden" name="id" value="<?php echo $modelData['id'] ?>" />
    <table>
	    <caption><?php echo $submitValue ?></caption>
		<tr>
			<td>
				<label>設備識別碼：<input type="text" name="identify" value="<?php echo $modelData['identify'] ?>" /></label>
			</td>
		</tr>
		<tr>
			<td>
				<label>設備地點：<input type="text" name="location" value="<?php echo $modelData['location'] ?>" /></label>
			</td>
		</tr>
		<tr>
			<td>
				<label>設備狀態：
					<select required name="status">
						<option value="">請選擇設備狀態</option>
						<?php foreach ($statues as $status): ?>
							<option value="<?php echo $status['code'] ?>" <?php echo $modelData['status'] == $status['code'] ? 'selected' : '' ?>><?php echo $status['message'] ?></option>
						<?php endforeach ?>
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				<label>
					設備型號：
					<select name="model_id" required>
						<option value="">請選擇設備型號</option>
						<?php foreach($models as $model): ?>
							<option value="<?php echo $model['id'] ?>" <?php echo $modelData['model_id'] == $model['id'] ? 'selected' : '' ?>><?php echo $model['model'] ?></option>
						<?php endforeach ?>
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				<label>備註：<textarea name="note"><?php echo $modelData['note'] ?></textarea></label>
			</td>
		</tr>
		<tr>
			<td>
				<label>預計報廢時間：<input type="date" name="duedate" value="<?php echo $modelData['duedate'] ?>" /></label>
			</td>
		</tr>
		<tr>
			<td>
				<label>成本：<input type="number" name="cost" value="<?php echo $modelData['cost'] ?>" /></label>
			</td>
		</tr>
		<tr>
			<td>
				<label>現值：<input type="number" name="value" value="<?php echo $modelData['value'] ?>" /></label>
			</td>
		</tr>
		<tr>
			<td>
				<label>保管人：<input type="text" name="keeper" value="<?php echo $modelData['keeper'] ?>"</label>
			</td>
		</tr>
		<tr>
			<td>
				<label>使用人：<input type="text" name="user" value="<?php echo $modelData['user'] ?>"</label>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="<?php echo $submitValue ?>" />
			</td>
		</tr>
    </table>
</form>

<?php if(!is_null($redirectUrl)): ?>
	<a href="<?php echo $redirectUrl ?>">返回</a>
<?php endif ?>
