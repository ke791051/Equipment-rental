<?php
/**
 * anticipate:
 *  - array $categories 格式符合Model回傳的型號分類格式
 *  - string $navigateUrl 導覽網址，假設分頁資料是用GET方法傳送，格式為?perpage=int&page=int
 *  - string $postEditUrl 編輯操作的post連結，使用id為名稱傳送資料庫編號
 *  - string $postDeleteUrl 刪除操作的post連結，使用id為名稱傳送資料庫編號
 *  - array $operators 是否要顯示指定操作，格式為array('delete' => boolean, 'edit' => boolean)
 *  - Pagination $pagination
 *  - string $caption 頁面標題
 *  
 */
?>

<h1><?php echo $caption ?></h1>
<?php if ($categories): ?>
	<?php echo $pagination->createLinks() ?>
	<table border="3">
		<thead>
			<tr>
				<th>設備分類名稱</th>
				<?php if (in_array(True, $operators)): ?>
					<th>操作</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($categories as $category): ?>
				<tr>
					<td><?php echo $category['name'] ?></td>
					<?php if (in_array(True, $operators)): ?>
						<td>
							<?php if ($operators['edit']): ?>
								<form action="<?php echo $postEditUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $category['id'] ?>" />
									<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
									<input type="submit" value="編輯" />
								</form>
							<?php endif ?>
							<?php if ($operators['delete']): ?>
								<form action="<?php echo $postDeleteUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $category['id'] ?>" />
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