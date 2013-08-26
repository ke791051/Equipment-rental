<pre>
<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../../config.php';

$userModel = new UserModel();

// 新增使用者
$accountName = 'Monshin';
$password = 'ILove4413!';
$username = 'Monshin Feng';
$phone = '4413';
$sy = '二技';
$email = 'tuc4413@gmail.com';
$permission = "SuperAdmin";
$active = True;
//*
if ($userModel->addUser($accountName, $password, $username, $sy, $email, $phone, $permission, $active)) {
	print "使用者新增成功\n";	
} else {
	print "使用者新增失敗\n";
	print $userModel->getStatementErrorMessage();
}
//*/

// 更新使用者資料
/*
if ($userModel->updateUserByAccountName($accountName, $username, $sy, $email, '44131216', $permission, $active))
{
	print "更新成功\n";
} else {
	print "更新失敗\n";
	print $userModel->getStatementErrorMessage();
}
//*/

// 更新使用者密碼
/*
if ($userModel->updateUserPasswordByAccountName($accountName, $password)) {
	print "密碼更新成功\n";
} else {
	print "密碼更新失敗\n";
	print $userModel->getStatementErrorMessage();
}
//*/

// 停用指定使用者帳號
/*
if ($userModel->unactivateUserByAccountName($accountName)) {
	print "帳號停用成功\n";
} else {
	print "帳號停用失敗\n";
	print $userModel->getStatementErrorMessage();
}
//*/

// 啟用指定使用者帳號
/*
if ($userModel->activateUserByAccountName($accountName)) {
	print "帳號啟用成功\n";
} else {
	print "帳號啟用失敗\n";
	print $userModel->getStatementErrorMessage();
}
//*/

?>
</pre>