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

<table border="3">
	<caption><?php echo $caption ?></caption>
	<thead>
		<tr>
			<th>設備識別碼</th>
			<?php if (in_array(True, $operators)): ?>
				<th>設備存放地點</th>           
	            <th>狀態</th>
	            <th>備註</th>
	            <th>報廢日期</th>
	            <th>成本</th>
	            <th>現值</th>
	            <th>保管人</th>
	            <th>使用人</th>
	            <th>操作</th>
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
				<?php if ($page != $totalPages): ?>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $page + 1, 'perpage' => $perpage))?>">下一頁</a>
					<a href="<?php echo $navigateUrl . '?' . http_build_query(array('page' => $totalPages, 'perpage' => $perpage))?>">最末頁</a>
				<?php endif ?>
			<?php endif ?>
		</p>
	</tfoot>
</table>