<?php
/**
 * 列出使用者資料
 * 
 * 此列表不顯示會員密碼
 * 
 * Anticipate:
 *  - array $modelsData array(array(...UserModelData...),
 * 							  array...)
 *  - string $navigateUrl
 *  - int $perPage
 *  - int $page
 *  - int $totalPages
 *  - string $caption
 *  - string $postEditUrl
 *  - string $postDeleteUrl
 *  - string $postEditPasswordUrl
 *  - string $getSearchUrl
 *  - array $operators array('edit' => boolean, 'delete' => boolean, 'editpassword' => boolean)
 */
?>
<form action="<?php echo $getSearchUrl ?>" method="get"> 
	<label>
		學號搜尋
		<input type="text" name="search_identify" value=""/>
	</label>
    <input type="submit" value="搜尋"/>
</form>
<!-- @formatter:off -->
<?php if (!$modelsData): ?>
	<p>無會員資料可以顯示</p>
<?php else: ?>
<table>
	<caption><?php echo $caption ?></caption>
	<thead>
		<tr>
			<th>帳號</th>
			<th>姓名</th>
			<th>班級</th>
			<th>學號</th>
			<th>電子郵件</th>
			<th>電話</th>
			<th>權限</th>
			<th>是否啟用</th>
			<?php if (in_array(True, $operators, True)): ?>
				<th>操作</th>
			<?php endif ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($modelsData as $modelData): ?>
			<tr>
				<td><?php echo $modelData['id'] ?></td>
				<td><?php echo $modelData['name'] ?></td>
				<td><?php echo $modelData['sy'] ?></td>
				<td><?php echo $modelData['identify'] ?></td>
				<td><?php echo $modelData['mail'] ?></td>
				<td><?php echo $modelData['phone'] ?></td>
				<td><?php echo new UserRank($modelData['Permission']) ?></td>
				<td><?php echo $modelData['NY'] ? '已啟用' : '已停用' ?></td>
				<?php if ($operators): ?>
				<td>
					<?php if ($operators['edit']): ?>
						<form action="<?php echo $postEditUrl ?>" method="post">
							<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('perpage' => $perpage, 'page' => $page)) ?>" />
							<input type="hidden" name="id" value="<?php echo $modelData['id']?> " />
							<input type="submit" value="編輯" />
						</form>
					<?php endif ?>
					
					<?php if ($operators['delete']): ?>
						<form action="<?php echo $postDeleteUrl ?>" method="post">
							<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('perpage' => $perpage, 'page' => $page)) ?>" />
							<input type="hidden" name="id" value="<?php echo $modelData['id']?> " />
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
<?php endif ?>

