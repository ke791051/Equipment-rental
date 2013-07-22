<pre>
<?php
require_once '../modelmodel.php';
$modelmodel = new ModelModel() ;
//新增設備型號
/*
if ($modelmodel->addModel(1, 'ASUS ZendBook')) {
    print "設備型號新增成功\n";
} else {
    print "設備型號新增失敗\n";
    print $modelmodel->getStatementErrorMessage();
}
//*/

// 更新指定的設備型號
/*
if ($modelmodel->updateModelById(6, 1, 'ASUS ZendBook')) {
    print "設備型號更新成功\n";
} else {
    print "設備型號更新失敗\n";
    print $modelmodel->getStatementErrorMessage();
}
//*/

// 移除指定的設備型號
/*
if ($modelmodel->removeModelById(5)) {
    print "設備型號移除成功\n";
} else {
    print "設備型號移除失敗\n";
    print $modelmodel->getStatementErrorMessage();
}
//*/

// 取得所有設備型號
print_r($modelmodel->get());

// 取得指定種類的設備型號
//print_r($modelmodel->getByCategoryId(1));

// 取得指定資料庫編號的設備型號
//print_r($modelmodel->getById(1));
?>
</pre>