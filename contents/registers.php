<?php
/**
 * anticipate:
 *   - array $registers array(array('register' => array('id' => value,
 * 														'note' => value,
 * 														'ispass' => value,
 * 														'finish_time' => value,
 * 														'instances_id' => value,
 * 														'user_id' => value,
 * 														'register_time' => value)),
 * 									'model' => array('id' => value,
 * 													 'model' => value,
 * 													 'category_id' => value),
 * 									'category' => array('id' => value,
 * 														'name' => value),
 * 									'instance' => array(),
 * 									'user' => array(...Model取出的資料的格式...),
 * 									'verifyuser' => array(...Model取出的資料的格式...))
 *   - string $caption
 *   - string $navigateUrl
 *   - int $perPage
 *   - int $page
 *   - int $totalPages
 *   - string $postVerifyUrl
 *   - string $getSearchUrl
 *   - array $operators array('verify' => boolean)
 */
?>

<?php if (isset($getSearchUrl)): ?>
<form action="<?php echo $getSearchUrl ?>" method="get"> 
	<label>
		設備識別碼搜尋
		<input type="text" name="search_identify" value=""/>
	</label>
    <input type="submit" value="搜尋"/>
</form>
<?php endif ?>

<?php if ($registers): ?>
<div class="item_list">
	<table border="3" id="re_list">
		<h1><?php echo $caption ?></h1>
		<thead>
			<tr>
				<th>申請者班級</th>
				<th>申請者學號</th>
				<th>申請者</th>
				<th>申請者電話</th>
				<th>設備分類</th>
				<th>設備型號</th>
				<th>設備識別碼</th>
				<th>地點</th>
				<th>狀態</th>
				<th>申請日期</th>
				<th>審核者</th>
				<th>審核日期</th>
				<th>審核是否通過</th>
				<th>備註</th>
				<?php if (in_array(True, $operators)): ?>
					<th>操作</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($registers as $register): ?>
				<tr>
					<td><?php echo $register['user']['sy'] ?></td>
					<td><?php echo $register['user']['identify'] ?></td>
					<td><?php echo $register['user']['name'] ?></td>
					<td><?php echo $register['user']['phone'] ?></td>
					<td><?php echo $register['category']['name'] ?></td>
					<td><?php echo $register['model']['model'] ?></td>
					<td><?php echo $register['instance']['identify'] ?></td>
					<td><?php echo $register['instance']['location'] ?></td>
					<td><?php echo (new InstanceStatus($register['instance']['status']))->getStatusMessage() ?></td>
					<td><?php echo $register['register']['register_time'] ?></td>
					<td><?php echo $register['verifyuser']['name'] ?></td>
					<td><?php echo $register['register']['finish_time'] ?></td>
					<?php if (!is_null($register['register']['ispass'])): ?>
						<td><?php echo $register['register']['ispass'] ? '通過' : '不通過' ?></td>
					<?php else: ?>
						<td>尚未審核</td>
					<?php endif ?>
					<td><?php echo $register['register']['note'] ?></td>
					<?php if (in_array(True, $operators)): ?>
						<td>
							<?php if ($operators['verify'] and is_null($register['register']['ispass'])): ?>
								<form action="<?php echo $postVerifyUrl ?>" method="post">
									<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('perpage' => $perpage, 'page' => $page)) ?>" />
									<input type="hidden" name="id" value="<?php echo $register['register']['id'] ?>" />
									<input type="submit" value="審核" />
								</form>
							<?php endif ?>
							<!-- <?php if ($operator['cancel'] and is_null($register['register']['ispass'])): ?>
								<form action="<?php echo $postCancelUrl ?>" method="post">
									<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('perpage' => $perpage, 'page' => $page)) ?>" />
									<input type="hidden" name="id" value="<?php echo $register['register']['id'] ?>" />
									<input type="submit" value="取消申請" />
								</form>
							<?php endif ?> -->
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
<?php else: ?>
	<p>目前無任何資料可以顯示</p>
<?php endif ?>
</div>