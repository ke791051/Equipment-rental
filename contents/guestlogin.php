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
<div class="item_list">
	
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
	<div id='page_load'>
		<input type="button" id="close" value="X">
		<form action="<?php echo $postUrl ?>" method="post" >
			<table>
				<tbody>
					<tr id='class'>
						<td><label>班級：</label><input type="text" name="sy" class="null_validate" value="<?php echo $modelData['sy'] ?>" required /></td><td><label class="vali_info"></</label></td>
					</tr>
					<tr id='id'>
						<td><label>學號：</label><input type="text" name="identify" class="null_validate" value="<?php echo $modelData['identify'] ?>" required /></td><td><label class="vali_info"></</label></td>
					</tr>
					<tr id='name'>
						<td><label>姓名：</label><input type="text" name="name" class="null_validate" value="<?php echo $modelData['name'] ?>" required /></td><td><label class="vali_info"></</label></td>
					</tr>
					<tr id='tel'>
						<td><label>電話：</label><input type="tel" name="phone" class="tel_validate" value="<?php echo $modelData['phone'] ?>" required /></td><td><label id="info">(例:04-22195999或0928-xxxxxx)</</label></td>
					</tr>
					<tr id='button'>
						<!--<td><input type="submit" value="<?php echo $caption ?>" /></td>-->
						<td colspan="2"><input type="submit" id="submit" value="<?php echo $caption ?>" /></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>