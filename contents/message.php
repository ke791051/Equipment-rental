<?php
/**
 * anticipate:
 *  - string $caption
 *  - array $infos
 *  - array $errors
 *  - string $redirectUrl
 */
?>

<h1><?php echo $caption ?></h1>

<ul>
	<?php foreach($infos as $info): ?>
		<li><?php echo $info ?></li>
	<?php endforeach ?>
</ul>

<ul>
	<?php foreach($errors as $error): ?>
		<li><?php echo $error ?></li>
	<?php endforeach ?>
</ul>

<a href="<?php echo $redirectUrl ?>">返回</a>
