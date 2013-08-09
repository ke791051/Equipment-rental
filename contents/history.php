<?php
/* Anticipate:
 *  - string $caption
 *  - array $lends array(array('lend' => ...lend Model Data...,
 * 							   'instance' => ...instance Model Data...,
 * 							   'model' => ...model Model Data...
 * 							   'category' => ...category Model Data...,
 * 							   'user' => ...user Model Data...))
 *  - string $postLendBackUrl
 *  - array $operators array('lendBack' => boolean)	
 *  - string $navigateUrl
 *  - int $perpage
 *  - int $page
 *  - int $totalPages			
 * 
 */
?>
<table border="3">
	<caption><?php echo $caption ?></caption>
	<thead>
		<tr>
			<th>學制</th>
			<th>姓名</th>
			<th>出借設備分類</th>
			<th>出借設備型號</th>
			<th>出借設備識別碼</th>
			<th>出借起始日期</th>
			<th>預計歸還日期</th>
			<th>歸還日期</th>
			<th>備註</th>
			<?php if (in_array(True, $operators)): ?>
				<th>操作</th>
			<?php endif ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($lends as $lend): ?>
			<tr>
				<td><?php echo $lend['user']['sy'] ?></td>
				<td><?php echo $lend['user']['name'] ?></td>
				<td><?php echo $lend['category']['name'] ?></td>
				<td><?php echo $lend['model']['model'] ?></td>
				<td><?php echo $lend['instance']['identify'] ?></td>
				<td><?php echo $lend['lend']['since_date'] ?></td>
				<td><?php echo $lend['lend']['expected_back_date'] ?></td>
				<td><?php echo $lend['lend']['back_date'] ?></td>
				<td><?php echo $lend['lend']['note'] ?></td>
				<?php if (in_array(True, $operators)): ?>
					<td>
						<?php if ($operators['lendBack'] and !$lend['lend']['back_date'] and $lend['instance']['status'] != 1): ?>
							<form action="<?php echo $postLendBackUrl ?>" method="post">
								<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page, 'perpage' => $perpage))  ?>" />
								<input type="hidden" name="id" value="<?php echo $lend['lend']['id'] ?>" />
								<input type="submit" value="歸還" />
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