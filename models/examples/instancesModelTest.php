<pre>
<?php
header('Content-Type: text/html; charset=utf-8');
require '../../config.php';
$instancemodel = new InstanceModel();

// 新增設備
/*
if (($id = $instancemodel->addInstance('Penny-Dell', '2106', 0, '', NULL, 30000, 300000, 'Penny', 'Penny', 19)) !== FALSE) {
    print "新增成功 {$id}\n";
} else {
    print "新增失敗\n";
    print $instancemodel->getStatementErrorMessage();
}
//*/

// 移除設備
/*
if ($instancemodel->removeInstanceById(3)) {
    print "移除成功\n";
} else {
    print "移除失敗\n";
    print $instancemodel->getStatementErrorMessage();
}
//*/

// 取得指定編號的設備
/*
print_r($instancemodel->getById(0));
//*/

// 取得指定辨識碼的設備
/*
print_r($instancemodel->getByIdentify('test001'));
//*/

// 取得所有設備
/*
print_r($instancemodel->get());
//*/

// 取得可被申請的設備
print_r($instancemodel->getInstancesCanBeRegistered());
print $instancemodel->getStatementErrorMessage();
?>
</pre>