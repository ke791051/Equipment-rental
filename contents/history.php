<?php
/* Anticipate:
 *  - string $caption
 *  - array $lends array(array('lend' => ...lend Model Data...,
 * 							   'instance' => ...instance Model Data...,
 * 							   'model' => ...model Model Data...
 * 							   'category' => ...category Model Data...,
 * 							   'user' => ...user Model Data...,
 * 							   'lendbackuser' => ...user Model Data...,
 * 							   'verifyuser' => array(...Model取出的資料的格式...),
 * 							   'warning' => boolean))
 *  - string $postLendBackUrl
 *  - string $getSearchUrl
 *  - string|NULL $searchUserIdentifyUrl
 *  - array $operators array('lendBack' => boolean)	
 *  - Pagination $pagination
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
	<?php if ($lends): ?>
	
	<table border="3" id="re_list">
		<h1><?php echo $caption ?></h1>
		<?php $pagination->createLinks() ?>
		<thead>
			<tr>
				<th width='80'>班級</th>
				<th width='80'>學號</th>
				<th width='80'>姓名</th>
				<th width='90'>電話</th>
				<th width='100'>設備分類</th>
				<th width='160'>設備型號</th>
				<th width='160'>設備識別碼</th>
				<th width='80'>審核者</th>
				<th width='110'>起始日期</th>
				<th width='110'>歸還日期</th>
				<th width='110'>歸還日期</th>
				<th width='80'>歸還審核者</th>
				<th width='50'>備註</th>
				<?php if (in_array(True, $operators)): ?>
					<th width='50'>操作</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($lends as $lend): ?>
				<tr <?php echo $lend['warning'] ? 'class="warning"' : '' ?>>
					<td><?php echo $lend['user']['sy'] ?></td>
					<td><?php if ($searchUserIdentifyUrl): ?>
							<a href="<?php echo $searchUserIdentifyUrl . '?' . http_build_query(array('search_identify' => $lend['user']['identify'])) ?>"><?php echo $lend['user']['identify'] ?></a>
						<?php else: ?>	
							<?php echo $lend['user']['identify'] ?>
						<?php endif ?>
					</td>
					<td><?php echo $lend['user']['name'] ?></td>
					<td><?php echo $lend['user']['phone'] ?></td>
					<td><?php echo $lend['category']['name'] ?></td>
					<td><?php echo $lend['model']['model'] ?></td>
					<td><?php echo $lend['instance']['identify'] ?></td>
					<td><?php echo $lend['verifyuser']['name'] ?></td>
					<td><?php echo $lend['lend']['since_date'] ?></td>
					<td><?php echo $lend['lend']['expected_back_date'] ?></td>
					<td><?php echo $lend['lend']['back_date'] ?></td>
					<td><?php echo $lend['lendbackuser']['name'] ?></td>
					<td><?php echo $lend['lend']['note'] ?></td>
					<?php if (in_array(True, $operators)): ?>
						<td>
							<?php if ($operators['lendBack'] and !$lend['lend']['back_date'] and $lend['instance']['status'] != 1): ?>
								<form action="<?php echo $postLendBackUrl ?>" method="post">
									<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink()  ?>" />
									<input type="hidden" name="id" value="<?php echo $lend['lend']['id'] ?>" />
									<input type="submit" value="歸還" />
								</form>
							<?php endif ?>
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