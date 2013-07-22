<pre>
<?php
require_once '../registermodel.php';

$registermodel = new RegisterModel();
header('Content-Type: text/html; charset=utf-8;');

// 設備出借申請
/*
if ($insertId = $registermodel->register(123, 0)) {
    print "出借申請成功\n";
    print "${insertId}\n";
} else {
    print "出借申請失敗\n";
    print $registermodel->getStatementErrorMessage();
}
//*/

// 審核設備出借申請
/*
if ($registermodel->verifyById(2, False, '小清IBM不會借人的')) {
    print "審核成功\n";
} else {
    print "審核失敗\n";
    print $registermodel->getStatementErrorMessage();
}
//*/

// 取得所有設備申請紀錄
//print_r($registermodel->get());

// 取得指定的設備申請紀錄
//print_r($registermodel->getById(1));

// 取得指定狀態的設備申請紀錄
print_r($registermodel->getByIsPass(NULL));
?>
</pre>