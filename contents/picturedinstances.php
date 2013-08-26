<?php
/**
 * 顯示附加圖片的設備，此頁面有導覽列
 * 
 * Anticipate:
 *   - array $modelData array(array('model' => ... model Model Data...,
 * 							  		'category' => ... category Model Data...,
 * 							  		'instances' => array(...instance Model Data...,
 * 										 			     ...),
 * 							  		'model_image' => array('name' => imageName,
 * 													 	   'path' => imageUrlPath))
 * 							  ...)
 *   - array $categories
 * 	 - string $queryCategory
 *   - string $caption
 *   - string $postRegisterUrl
 *   - Pagination $instancesPagination
 *   - array $operators array('register' => boolean)
 */
?>
<head>
	<link rel="stylesheet" href="css/picturedinstances.css" type="text/css" charset="utf-8" />
</head>

<div class="item_class">
	<ul>
		<?php foreach ($categories as $category): ?>
			<li><a href="<?php echo $navigateUrl . '?' . http_build_query(array('category' => $category['name'])) ?>"><?php echo $category['name'] ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>

<div class="item_list">
	<h1><?php echo $caption ?></h1>
	<?php foreach($modelData as $model): ?>
		<div class="item">
			<h2><?php echo $model['model']['model'] ?></h2>
			<img width="240" height="210" src="<?php echo $model['model_image']['path'] ?>" alt="<?php echo $model['model_image']['name'] ?>" />
			<?php if ($operators['register']): ?>
				<form action="<?php echo $postRegisterUrl ?>" method="post">
					<input type="hidden" name="postfromurl" value="<?php echo $instancesPagination->getCurrentLink() ?>" />
					<table>
						<tr>
							<td>
								<select name="id" required>
									<option value="">請選擇要申請的設備</option>
									<?php foreach($model['instances'] as $instance): ?>
										<option value="<?php echo $instance['id'] ?>"><?php echo $instance['identify'] ?></option>
									<?php endforeach ?>
								</select>
							</td>
							<td>
								<input type="submit" value="申請" />
							</td>
						</tr>
					</table>
				</form>
			<?php endif ?>
		</div>
	<?php endforeach ?>
	
	<?php echo $instancesPagination->createLinks() ?>
</div>