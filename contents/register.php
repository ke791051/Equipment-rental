<?php
/**
 * 填寫設備申請資料頁面
 * 
 * Anticipate:
 *  - array $modelData array('instance' => Instance model data,
 * 							 'user' => User model data)
 *  - string $postUrl
 *  - string $redirectUrl
 *  - string $caption
 *  - array $errors
 *  - array $infos
 */
?>
<h1><?php echo $caption ?></h1>

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
	<table>
		<?php if ($redirectUrl): ?>
			<input type="hidden" name="redirecturl" value="<?php echo $redirectUrl ?>" />
		<?php endif ?>
		<input type="hidden" name="instance_id" value="<?php echo $modelData['instance']['id'] ?>" />
		<tbody>
			<tr>
				<td><label>設備識別碼：<input type="text" name="identify" value="<?php echo $modelData['instance']['identify'] ?>" disabled /></label></td>
			</tr>
			<tr>
				<td><label>設備地點：<input type="text" name="location" value="<?php echo $modelData['instance']['location'] ?>" disabled /></label></td>
			</tr>
			<tr>
				<td><label>備註：<textarea name="note" disabled><?php echo $modelData['instance']['note'] ?></textarea></label></td>
			</tr>
			<tr>
				<td><label>申請者班級：<input type="text" name="sy" value="<?php echo $modelData['user']['sy'] ?>" required /></label></td>
			</tr>
			<tr>
				<td><label>申請者學號：<input type="text" name="identify" value="<?php echo $modelData['user']['identify'] ?>" required /></label></td>
			</tr>
			<tr>
				<td><label>申請者姓名：<input type="text" name="name"	 value="<?php echo $modelData['user']['name'] ?>" required /></label></td>
			</tr>
			<tr>
				<td><label>申請者電話：<input type="tel" name="phone" value="<?php echo $modelData['user']['phone'] ?>" required /></label></td>
			</tr>
			<tr>
				<td><input type="submit" value="<?php echo $caption ?>" /></td>
			</tr>
		</tbody>
	</table>
</form>

<?php if ($redirectUrl): ?>
	<a href="<?php echo $redirectUrl?>">返回</a>
<?php endif ?>
