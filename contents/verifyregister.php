<?php
/**
 * anticipate:
 *   - array $register array('register' => array('id' => value,
 * 											  	 'note' => value,
 * 												 'ispass' => value,
 * 												 'finish_time' => value,
 * 												 'instances_id' => value,
 * 												 'user_id' => value,
 * 												 'register_time' => value)),
 * 							 'model' => array('id' => value,
 * 					 						  'model' => value,
 * 											  'category_id' => value),
 * 							 'category' => array('id' => value,
 * 												 'name' => value),
 * 							 'instance' => array('id' => value
 * 												 'identify' => value
 * 												 ...),
 * 							 'user' => array(...Model取出的資料的格式...)
 *   - string $postUrl
 *   - string $expectedBackDate
 *   - string|NULL $redirectUrl
 *   - string $submitValue
 *   - array $errors
 *   - array $infos
 */
?>

<h1><?php echo $submitValue ?></h1>

<div>
	<ul>
		<?php foreach ($errors as $error): ?>
			<li><?php echo $error ?></li>
		<?php endforeach ?>
	</ul>
</div>

<div>
	<ul>
		<?php foreach ($infos as $info): ?>
			<li><?php echo $info ?></li>
		<?php endforeach ?>
	</ul>
</div>
<form action="<?php echo $postUrl ?>" method="post" >
	<input type="hidden" name="id" value="<?php echo $register['register']['id'] ?>" />
	<?php if (!is_null($redirectUrl)): ?>
		<input type="hidden" name="redirecturl" value="<?php echo $redirectUrl ?>" />
	<?php endif ?>
	<ol>
		<li><label>申請者學制：<input type="text" value="<?php echo $register['user']['sy']?>" disabled /></label></li>
		<li><label>申請者：<input type="text" value="<?php echo $register['user']['name']?>" disabled /></label></li>
		<li><label>申請時間：<input type="datetime" value="<?php echo $register['register']['register_time'] ?>" disabled/></label></li>
		<li><label>申請設備分類：<input type="text" value="<?php echo $register['category']['name'] ?>" disabled /></label></li>
		<li><label>申請設備型號：<input type="text" value="<?php echo $register['model']['model'] ?>" disabled/></label></li>
		<li><label>申請設備識別碼：<input type="text" value="<?php echo $register['instance']['identify'] ?>" disabled /></label></li>
		<li><label>申請設備地點：<input type="text" value="<?php echo $register['instance']['location'] ?>" disabled /></label></li>
		<li><label><input type="checkbox" name="ispass" value="1" <?php echo $register['register']['ispass'] ? 'checked' : '' ?> />審核是否通過？</label></li>
		<li><label>設備歸還期限：<input type="date" name="expected_back_date" value="<?php echo $expectedBackDate ?>" /></label></li>
		<li><label>備註：<textarea name="note"><?php echo $register['register']['note'] ?></textarea></label></li>
		<li><input type="submit" value="<?php echo $submitValue ?>" /></li>
	</ol>
</form>

<?php if (!is_null($redirectUrl)): ?>
	<a href="<?php echo $redirectUrl ?>">返回</a>
<?php endif ?>