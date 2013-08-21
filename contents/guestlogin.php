<?php
/**
 * Anticipate:
 *  - array $modelData array(...User model data...)
 *  - string $caption
 *  - string $postUrl
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
	<?php foreach($infos as $info): ?>
		<li><?php echo $info ?></li>
	<?php endforeach ?>
</ul>

<form action="<?php echo $postUrl ?>" method="post" >
	<table>
		<tbody>
			<tr>
				<td><label>班級：<input type="text" name="sy" value="<?php echo $modelData['sy'] ?>" required /></label></td>
			</tr>
			<tr>
				<td><label>學號：<input type="text" name="identify" value="<?php echo $modelData['identify'] ?>" required /></label></td>
			</tr>
			<tr>
				<td><label>姓名：<input type="text" name="name" value="<?php echo $modelData['name'] ?>" required /></label></td>
			</tr>
			<tr>
				<td><label>電話：<input type="tel" name="phone" value="<?php echo $modelData['phone'] ?>" required /></label></td>
			</tr>
			<tr>
				<td><input type="submit" value="<?php echo $caption ?>" /></td>
			</tr>
		</tbody>
	</table>
</form>