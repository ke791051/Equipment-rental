<?php
/**
 * Anticipate:
 *   - array $lend 	   array('lend' => ...Register Model Data...,
 * 							 'instance' => ...Instance Model Data...,
 * 							 'model' => ...Model Model Data...
 *  						 'category' => ...Category Model Data,
 * 							 'user' => ...User Model Data...)
 *   - string $submitValue
 *   - string $lendBackDate
 *   - string $postBackUrl
 *   - string $redirectUrl
 */
?>

<h1><?php echo $submitValue ?></h1>

<form action="<?php echo $postBackUrl ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $lend['lend']['id'] ?>" />
	<?php if ($redirectUrl): ?>
		<input type="hidden" name="redirecturl" value="<?php echo $redirectUrl ?>" />
	<?php endif ?>	
	<ol>
		<li><label>歸還時間：<input type="date" name="lendbackdate" value="<?php echo $lendBackDate ?>" required /></label></li>
		<li><label>備註：<textarea name="note"></textarea></label></li>
		<li><input type="submit" value="<?php echo $submitValue ?>" /></li>
	</ol>
</form>

<?php if ($redirectUrl): ?>
	<a href="<?php echo $redirectUrl ?>">返回</a>
<?php endif ?>