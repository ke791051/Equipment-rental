<?php
/**
 * 列出使用者資料
 * 
 * 此列表不顯示會員密碼
 * 
 * Anticipate:
 *  - array $modelsData array(array(...UserModelData...),
 * 							  array...)
 *  - Pagination $pagination
 *  - string $caption
 *  - string $postEditUrl
 *  - string $postDeleteUrl
 *  - string $postEditPasswordUrl
 *  - string $getSearchUrl
 *  - array $operators array('edit' => boolean, 'delete' => boolean, 'editpassword' => boolean)
 */
?>
<div id="search_div">
	<form action="<?php echo $getSearchUrl ?>" method="get"> 
		<label>
			學號搜尋
			<input type="text" name="search_identify" value=""/>
		</label>
	    <input type="submit" value="搜尋"/>
	</form>
</div>
<!-- @formatter:off -->
<?php if (!$modelsData): ?>
	<p>無會員資料可以顯示</p>
<?php else: ?>
<div class="item_list">
	<h1><?php echo $caption ?></h1>
	<?php echo $pagination->createLinks() ?>
	<table id="re_list">
		<thead>
			<tr>
				<th width='400'>帳號</th>
				<th width='85'>姓名</th>
				<th width='50'>班級</th>
				<th width='60'>學號</th>
				<th width='145'>電子郵件</th>
				<th width='65'>電話</th>
				<th width='45'>權限</th>
				<th width='45'>狀態</th>
				<?php if (in_array(True, $operators, True)): ?>
					<th width='110'>操作</th>
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
								<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
								<input type="hidden" name="id" value="<?php echo $modelData['id']?> " />
								<input type="submit" value="編輯" />
							</form>
						<?php endif ?>
						
						<?php if ($operators['delete']): ?>
							<form action="<?php echo $postDeleteUrl ?>" method="post">
								<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
								<input type="hidden" name="id" value="<?php echo $modelData['id']?> " />
								<input type="submit" value="刪除" />
							</form>
						<?php endif ?>						
					</td>
					<?php endif ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php endif ?>