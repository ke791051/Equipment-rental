<?php
/**
 * anticipate:
 *  - array $models 符合Model回傳的設備型號資料
 *  - Pagination $pagination
 *  - string $postDeleteUrl 刪除連結，使用POST傳送設備型號的資料庫編號
 *  - string $postEditUrl 編輯連結，使用POST傳送設備型號的資料庫編號
 *  - array $operators 可用操作設定，格式為array('delete' => boolean, 'edit' => boolean)
 */
?>
<div class="item_list">
	<h1><?php echo $caption ?></h1>
	<?php if ($models): ?>
		<?php echo $pagination->createLinks() ?>
		<table border="3" id="re_list">
			<thead>
				<tr>
					<th width='300'>設備型號分類名稱</th>
					<?php if (in_array(True, $operators)): ?>
						<th width='300'>設備型號</th>
			            <th width='405'>設備種類</th>
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
										<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
										<input type="submit" value="編輯" />
									</form>
								<?php endif ?>
								<?php if ($operators['delete']): ?>
									<form action="<?php echo $postDeleteUrl ?>" method="post">
										<input type="hidden" name="id" value="<?php echo $model['id'] ?>" />
										<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
										<input type="submit" value="刪除" />
									</form>
								<?php endif ?>
							</td>
						<?php endif ?>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>無任何資料可以顯示</p>
	<?php endif ?>
</div>