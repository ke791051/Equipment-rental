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
 *   - string $caption
 *   - string $postRegisterUrl
 *   - string $perpage
 *   - string $page
 *   - string $totalPages
 *   - string $navigateUrl
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
		<div>
			<h2><?php echo $model['model']['model'] ?></h2>
			<img width="240" height="210" src="<?php echo $model['model_image']['path'] ?>" alt="<?php echo $model['model_image']['name'] ?>" />
			<?php if ($operators['register']): ?>
				<form action="<?php echo $postRegisterUrl ?>" method="post">
					<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('perpage' => $perpage, 'page' => $page)) ?>" />
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
	
	<p>
		<?php if ($totalPages != 1): ?>
			<?php if ($page != 1): ?>
				<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => 1, 'perpage' => $perpage)) ?>">第一頁</a>
				<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page - 1, 'perpage' => $perpage))?>">上一頁</a>
			<?php endif ?>
			<?php if ($page != $totalPages): ?>
				<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page + 1, 'perpage' => $perpage))?>">下一頁</a>
				<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $totalPages, 'perpage' => $perpage))?>">最末頁</a>
			<?php endif ?>
		<?php endif ?>
	</p>
</div>