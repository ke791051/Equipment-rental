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
 *   - Pagination $pagination
 *   - string $postVerifyUrl
 *   - string $getSearchUrl
 *   - array $operators array('verify' => boolean)
 */
?>
<?php if (isset($getSearchUrl)): ?>
<div id="search_div">
    <form action="<?php echo $getSearchUrl ?>" method="get"> 
        <label>
            設備識別碼搜尋
            <input type="text" name="search_identify" value=""/>
        </label>
        <input type="submit" value="搜尋"/>
    </form>
</div>
<?php endif ?>

<div class="item_list">
<?php if ($registers): ?>
	<h1><?php echo $caption ?></h1>
	<?php echo $pagination->createLinks() ?>
	<table border="3" id="re_list">
		<thead>
			<tr>
				<th width='80'>學生班級</th>
				<th width='80'>學生學號</th>
				<th width='80'>學生姓名</th>
				<th width='80'>學生電話</th>
				<th width='100'>設備分類</th>
				<th width='160'>型號</th>
				<th width='160'>識別碼</th>
				<th width='120'>地點</th>
				<th width='50'>狀態</th>
				<th width='110'>申請日期</th>
				<th width='80'>審核者</th>
				<th width='110'>審核日期</th>
				<th width='80'>審核狀態</th>
				<th width='50'>備註</th>
				<?php if (in_array(True, $operators)): ?>
					<th width='60'>操作</th>
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
									<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
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
	</table>
<?php else: ?>
	<p>目前無任何資料可以顯示</p>
<?php endif ?>
</div>