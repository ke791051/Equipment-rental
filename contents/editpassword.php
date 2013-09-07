<?php
/**
 * Anticipate:
 *  - array $modelData user model data
 *  - string $submitValue
 *  - string $postUrl
 *  - string $redirectUrl
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

<form action="<?php echo $postUrl ?>" method="post">
	<table>
		<h1><?php echo $submitValue ?></h1>
		<input type="hidden" name="id" value="<?php echo $modelData['id'] ?>" />
		<?php if ($redirectUrl): ?>
			<input type="hidden" name="redirecturl" value="<?php echo $redirectUrl ?>" />
		<?php endif ?>
		<tr>
			<td>
				<label>新密碼：<input type="password" name="password" required/></label>
			</td>
		</tr>
		<tr>
			<td>
				<label>請再輸入一次密碼：<input type="password" name="verify_password" required/></label>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="<?php echo $submitValue ?>" />
			</td>
		</tr>
	</table>
</form>

<?php if ($redirectUrl): ?>
	<a href="<?php echo $redirectUrl ?>">返回</a>
<?php endif ?>

