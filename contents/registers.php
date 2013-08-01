<?php
/**
 * anticipate:
 *   - array $registersWithFullData array(array('id' => 申請記錄的資料庫編號
 * 												'name' => 申請者名稱
 * 											    'category_name' => 設備分類名稱,
       										    'model' => 設備型號
 * 									      		'identify' => 設備識別碼,
 * 									      		'location' => 設備地點,
 * 										  		'register_time' => 設備申請時間,
 * 										  		'status' => 設備狀態,
 * 										  		'finish_time' => 審核時間,
 * 										  		'ispass' => 審核是否通過,
 * 										  		'note' => 備註))
 *   - string $title
 *   - string $navigateUrl
 *   - int $perPage
 *   - int $page
 *   - int $totalPages
 *   - string $postVerifyUrl
 *   - array $operators array('verify' => boolean)
 */
?>

<table>
	<caption><?php echo $title ?></caption>
	<thead>
		<th>申請者</th>
		<th>設備分類</th>
		<th>設備型號</th>
		<th>設備識別碼</th>
		<th>地點</th>
		<th>狀態</th>
		<th>申請日期</th>
		<th>審核日期</th>
		<th>審核是否通過</th>
		<th>備註</th>
		<?php if (in_array(True, $operators)): ?>
			<th>操作</th>
		<?php endif ?>
	</thead>
	<tbody>
		<?php foreach ($registersWithFullData as $registerWithFullData): ?>
			<tr>
				<td><?php echo $registerWithFullData['name'] ?></td>
				<td><?php echo $registerWithFullData['category_name'] ?></td>
				<td><?php echo $registerWithFullData['modell'] ?></td>
				<td><?php echo $registerWithFullData['identify'] ?></td>
				<td><?php echo $registerWithFullData['location'] ?></td>
				<td><?php echo $registerWithFullData['register_time'] ?></td>
				<td><?php echo (new InstanceStatus($registerWithFullData['status']))->getStatusMessage() ?></td>
				<td><?php echo $registerWithFullData['finish_time'] ?></td>
				<?php if (!is_null($registerWithFullData['ispass'])): ?>
					<td><?php echo $registerWithFullData['ispass'] ? '通過' : '不通過' ?></td>
				<?php else: ?>
					<td>尚未審核</td>
				<?php endif ?>
				<td><?php echo $registerWithFullData['note'] ?></td>
				<?php if (in_array(True, $operators)): ?>
					<td>
						<?php if ($operator['verify'] and is_null($registerWithFullData['ispass'])): ?>
							<form action="<?php echo $postVerifyUrl ?>" method="post">
								<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('perpage' => $perpage, 'page' => $page)) ?>" />
								<input type="hidden" name="id" value="<?php echo $registerWithFullData['id'] ?>" />
								<input type="submit" value="審核" />
							</form>
						<?php endif ?>
						<!-- <?php if ($operator['cancel'] and is_null($registerWithFullData['ispass'])): ?>
							<form action="<?php echo $postCancelUrl ?>" method="post">
								<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('perpage' => $perpage, 'page' => $page)) ?>" />
								<input type="hidden" name="id" value="<?php echo $registerWithFullData['id'] ?>" />
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
				<?php if ($page != $totalPages): ?>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page + 1, 'perpage' => $perpage))?>">下一頁</a>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $totalPages, 'perpage' => $perpage))?>">最末頁</a>
				<?php endif ?>
			<?php endif ?>
		</p>
	</tfoot>
</table>