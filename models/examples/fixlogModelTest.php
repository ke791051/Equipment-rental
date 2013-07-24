<pre>
<?php
require_once '../fixlogmodel.php';
$fixlogmodel = new FixLogModel() ;
//新增維修紀錄

/*if ($fixlogmodel->addFixLog(0, 'ASUS ZendBook', new DateTime())) {
    print "維修紀錄新增成功\n";
} else {
    print "維修紀錄新增失敗\n";
    print $fixlogmodel->getStatementErrorMessage();
}
//

// 更新指定的維修紀錄
/*
if ($fixlogmodel->finishFixById(5, new DateTime())) {
    print "維修紀錄更新成功\n";
} else {
    print "維修紀錄更新失敗\n";
    print $fixlogmodel->getStatementErrorMessage();
}
//

// 移除指定的維修紀錄

if ($fixlogmodel->removeFixLogById(5)) {
    print "維修紀錄移除成功\n";
} else {
    print "維修紀錄移除失敗\n";
    print $fixlogmodel->getStatementErrorMessage();
}
//*/

// 取得所有維修紀錄
//print_r($fixlogmodel->get());

// 取得指定資料庫編號的維修紀錄
//print_r($fixlogmodel->getById(5));

// 取得未修設備型號
//print_r($fixlogmodel->getNotFinishFix());

?>
</pre>