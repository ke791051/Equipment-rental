<?php
/**
 * anticipate:
 *  - array $instances 符合Model回傳格式的設備資料
 *  - string $navigateUrl 導覽網址，假設分頁資料是用GET方法傳送，格式為?perpage=int&page=int
 *  - int $perPage
 *  - int $page
 *  - int $totalPages
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
	<table border="3" class="re_list">
		<thead>
			<tr>
				<th width="130">設備識別碼</th>
				<?php if (in_array(True, $operators)): ?>
					<th width="100">設備存放地點</th>           
		            <th width="70">狀態</th>
		            <th width="70">備註</th>
		            <th width="65">取得日期</th>
		            <th width="65">報廢日期</th>
		            <th width="100">成本</th>
		            <th width="100">現值</th>
		            <th width="100">保管人</th>
		            <th width="100">使用人</th>
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
									<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page, 'perpage' => $perpage)) ?>" />
									<input type="submit" value="編輯" />
								</form>
							<?php endif ?>
							<?php if ($operators['delete']): ?>
								<form action="<?php echo $postDeleteUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $instance['id'] ?>" />
									<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page, 'perpage' => $perpage)) ?>" />
									<input type="submit" value="刪除" />
								</form>
							<?php endif ?>
	                        <?php if ($operators['register']): ?>
								<form action="<?php echo $postRegisterUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $instance['id'] ?>" />
									<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page, 'perpage' => $perpage)) ?>" />
									<input type="submit" value="註冊" />
								</form>
							<?php endif ?>
	                        <?php if ($operators['verify']): ?>
								<form action="<?php echo $postVerifyUrl ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $instance['id'] ?>" />
									<input type="hidden" name="postfromurl" value="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page, 'perpage' => $perpage)) ?>" />
									<input type="submit" value="審核" />
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
	<?php else: ?>
	<p>無任何資料可以顯示</p>
	<?php endif ?>
</div>