<?php
/* 編輯使用者資料的頁面（不包含密碼和使用者帳號）
 * 
 * 
 * Anticipate:
 *  - array $modelData userModelData
 *  - string $postUrl
 *  - string $redirectUrl
 *  - string $submitValue
 *  - boolean $isPasswordEditable
 *  - boolean $isIdEditable
 *  - array $permissions array(name => value,
 * 							   name => value, ...)
 *  - array $errors
 *  - array $infos
 */
?>

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

<form action="<?php echo $postUrl ?>" method="post" >
	<?php if ($redirectUrl): ?>
		<input type="hidden" name="postfromurl" value="<?php echo $redirectUrl ?>" />
	<?php endif ?>
	<table>
		<caption><?php echo $submitValue ?></caption>
		<tbody>
			<tr>
				<td><label for="id">帳號</label></td>
				<td><input type="text" name="id" value="<?php echo $modelData['id'] ?>" <?php echo $isIdEditable ? '' : 'readonly' ?> /></td>
			</tr>
			<tr>
				<td><label for="name">姓名</label></td>
				<td><input type="text" name="name" value="<?php echo $modelData['name'] ?>" /></td>
			</tr>
			<?php if ($isPasswordEditable): ?>
				<tr>
					<td><label for="pw">密碼</label></td>
					<td><input type="password" name="pw" /></td>
				</tr>
			<?php endif ?>
			<tr>
				<td><label for="sy">學制</label></td>
				<td><input type="text" name="sy" value="<?php echo $modelData['sy'] ?>" /></td>
			</tr>
			<tr>
				<td><label for="mail">電子郵件</label></td>
				<td><input type="email" name="mail" value="<?php echo $modelData['mail'] ?>" /></td>
			</tr>
			<tr>	
				<td><label for="phone">電話</label></td>
				<td><input type="tel" name="phone" value="<?php echo $modelData['phone'] ?>" /></td>
			</tr>
			<tr>
				<td><label for="Permission">權限</label></td>
				<td>
					
					<select name="Permission" required>
						<option value="">請選擇使用者的權限</option>
						<?php foreach($permissions as $name => $value): ?>
							<option value="<?php echo $value ?>" <?php echo $value == $modelData['Permission'] ? 'selected' : '' ?> ><?php echo $name ?></option>
						<?php endforeach ?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="NY">是否啟用帳號？</label></td>
				<td>
					<select name="NY" required>
						<option value="">請選擇啟用狀態</option>
						<option value="1" <?php echo $modelData['NY'] == 1 ? 'selected' : '' ?> >啟用</option>
						<option value="0" <?php echo (!is_null($modelData['NY']) and $modelData['NY'] != 1) ? 'selected' : '' ?> >停用</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="<?php echo $submitValue ?>" /></td>
			</tr>
		</tbody>
	</table>
</form>

<?php if ($redirectUrl): ?>
	<a href="<?php echo $redirectUrl ?>">返回</a>
<?php endif ?>
