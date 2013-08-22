<?php
/**
 * anticipate:
 *  - array $models 符合Model回傳的設備型號資料
 *  - string $navigateUrl 導覽網址，假設分頁資料是用GET方法傳送，格式為?perpage=int&page=int
 *  - int $perPage
 *  - int $page
 * 	- int $totalPages
 *  - string $postDeleteUrl 刪除連結，使用POST傳送設備型號的資料庫編號
 *  - string $postEditUrl 編輯連結，使用POST傳送設備型號的資料庫編號
 *  - array $operators 可用操作設定，格式為array('delete' => boolean, 'edit' => boolean)
 */
?>

<table border="3">
	<caption><?php echo $caption ?></caption>
	<thead>
		<tr>
			<th>設備型號分類名稱</th>
			<?php if (in_array(True, $operators)): ?>
				<th>設備型號</th>
	            <th>設備種類</th>
			<?php endif ?>
		</tr>
	</thead>
	<tbody>
    <?php
	$categoryModel = new CategoryModel();
	$categories = $categoryModel->get();
	?>
		<?php foreach ($models as $model): ?>
			<tr>
				<td><?php echo $model['model'] ?></td>
                <td><?php 
						foreach ($categories as $category):
							if ($category['id'] == $model['category_id']):
								echo $category['name'];
								break;
							endif;
						endforeach;
					?></td>
				<?php if (in_array(True, $operators)): ?>
					<td>
						<?php if ($operators['edit']): ?>
							<form action="<?php echo $postEditUrl ?>" method="post">
								<input type="hidden" name="id" value="<?php echo $model['id'] ?>" />
								<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page, 'perpage' => $perpage)) ?>" />
								<input type="submit" value="編輯" />
							</form>
						<?php endif ?>
						<?php if ($operators['delete']): ?>
							<form action="<?php echo $postDeleteUrl ?>" method="post">
								<input type="hidden" name="id" value="<?php echo $model['id'] ?>" />
								<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page, 'perpage' => $perpage)) ?>" />
								<input type="submit" value="刪除" />
							</form>
						<?php endif ?>
					</td>
				<?php endif ?>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<p>
			<?php if ($totalPages != 1): ?>
				<?php if ($page != 1): ?>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => 1, 'perpage' => $perpage)) ?>">第一頁</a>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page - 1, 'perpage' => $perpage))?>">上一頁</a>
				<?php endif ?>
				<?php foreach (range(1, $totalPages) as $apage): ?>
						<?php if ($page != $apage):?>
							<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $apage, 'perpage' => $perpage)) ?>"><?php echo $apage ?></a>
						<?php else: ?>
							<span><?php echo $apage ?></span>
						<?php endif ?>
				<?php endforeach ?>
				<?php if ($page != $totalPages): ?>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page + 1, 'perpage' => $perpage))?>">下一頁</a>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $totalPages, 'perpage' => $perpage))?>">最末頁</a>
				<?php endif ?>
			<?php endif ?>
		</p>
	</tfoot>
</table>