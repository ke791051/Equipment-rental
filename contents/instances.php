<?php
/**
 * anticipate:
 *  - array $instances 符合Model回傳格式的設備資料
 *  - Pagination $pagination
 *  - string $caption
 *  - string $postEditUrl
 *  - string $postDeleteUrl
 *  - string $postRegisterUrl
 *  - string $postVerifyUrl
 *  - array $operators 可用操作設定，格式為array('edit' => boolean, 'delete' => boolean, 'register' => boolean, 'verify' => boolean)
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
	<?php if ($instances): ?>
	<h1><?php echo $caption ?></h1>
	<table border="3" id="re_list">
		<?php echo $pagination->createLinks() ?>
		<thead>
			<tr>
				<th width="160">設備識別碼</th>
				<?php if (in_array(True, $operators)): ?>
					<th width="120">設備存放地點</th>           
		            <th width="50">狀態</th>
		            <th width="50">備註</th>
		            <th width="110">取得日期</th>
		            <th width="110">報廢日期</th>
		            <th width="100">成本</th>
		            <th width="100">現值</th>
		            <th width="80">保管人</th>
		            <th width="80">使用人</th>
		            <th width="110">操作</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
	    <?php $instancestatus = InstanceStatus::getStatusCodeMessageMapping(); ?>
			<?php foreach ($instances as $instance): ?>
				<tr>
					<td><?php echo $instance['identify'] ?></td>
	                <td><?php echo $instance['location'] ?></td>
	                <td>
	                <?php 
					foreach ($instancestatus as $a=>$b):
								if ($a == $instance['status']):
									echo $b;
									break;
								endif;
							endforeach;
					?></td>
	                <td><?php echo $instance['note'] ?></td>
	                <td><?php echo $instance['recorddate'] ?></td>
	                <td><?php echo $instance['duedate'] ?></td>
	                <td><?php echo $instance['cost'] ?></td>
	                <td><?php echo $instance['value'] ?></td>
	                <td><?php echo $instance['keeper'] ?></td>
	                <td><?php echo $instance['user'] ?></td>
					<?php if (in_array(True, $operators)): ?>
						<td>
							<?php if ($operators['edit']): ?>
								<form action="<?php echo $postEditUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $instance['id'] ?>" />
									<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
									<input type="submit" value="編輯" />
								</form>
							<?php endif ?>
							<?php if ($operators['delete']): ?>
								<form action="<?php echo $postDeleteUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $instance['id'] ?>" />
									<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
									<input type="submit" value="刪除" />
								</form>
							<?php endif ?>
	                        <?php if ($operators['register']): ?>
								<form action="<?php echo $postRegisterUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $instance['id'] ?>" />
									<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
									<input type="submit" value="註冊" />
								</form>
							<?php endif ?>
	                        <?php if ($operators['verify']): ?>
								<form action="<?php echo $postVerifyUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $instance['id'] ?>" />
									<input type="hidden" name="postfromurl" value="<?php echo $pagination->getCurrentLink() ?>" />
									<input type="submit" value="審核" />
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