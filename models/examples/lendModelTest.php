<?php
	header('Content-Type: text/html; charset=utf-8;');
?>
<pre>
<?php
    require '../lendmodel.php';
	$lendmodel = new LendModel();
	
	// 新增設備出借紀錄
	/*
	$backDate = new DateTime();
	$backDate->add(new DateInterval('P1Y'));
	if ($lendmodel->lend(123, 0, new DateTime(), $backDate)) {
		print "新增出借紀錄成功\n";
	} else {
		print "新增出借紀錄失敗\n";
		print $lendmodel->getStatementErrorMessage();
	}
	//*/
	
	// 歸還設備
	/*
	if ($lendmodel->backById(1)) {
		print "設備歸還成功\n";
	} else {
		print "設備歸還失敗\n";
		print $lendmodel->getStatementErrorMessage();
	}
	*/
	
	// 取得所有設備出借紀錄
	//print_r($lendmodel->get());
	
	// 取得指定的設備出借紀錄
	//print_r($lendmodel->getById(1));
?>
</pre>