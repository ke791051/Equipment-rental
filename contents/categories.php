<?php
/**
 * anticipate:
 *  - array $categories 格式符合Model回傳的型號分類格式
 *  - string $navigateUrl 導覽網址，假設分頁資料是用GET方法傳送，格式為?perpage=int&page=int
 *  - string $postEditUrl 編輯操作的post連結，使用id為名稱傳送資料庫編號
 *  - string $postDeleteUrl 刪除操作的post連結，使用id為名稱傳送資料庫編號
 *  - array $operators 是否要顯示指定操作，格式為array('delete' => boolean, 'edit' => boolean)
 *  - int $perPage 一頁顯示多少筆資料
 *  - int $page 目前的頁數
 *  - int $totalPages 全部頁數
 *  - string $caption 頁面標題
 *  
 */
?>

<table border="3">
	<caption><?php echo $caption ?></caption>
	<thead>
		<th>設備分類名稱</th>
		<?php if (in_array(True, $operators)): ?>
			<th>操作</th>
		<?php endif ?>
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
								<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page, 'perpage' => $perpage)) ?>" />
								<input type="submit" value="編輯" />
							</form>
						<?php endif ?>
						<?php if ($operators['delete']): ?>
							<form action="<?php echo $postDeleteUrl ?>" method="post">
								<input type="hidden" name="id" value="<?php echo $category['id'] ?>" />
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
				<?php if ($page != $totalPages): ?>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page + 1, 'perpage' => $perpage))?>">下一頁</a>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $totalPages, 'perpage' => $perpage))?>">最末頁</a>
				<?php endif ?>
			<?php endif ?>
		</p>
	</tfoot>
</table>