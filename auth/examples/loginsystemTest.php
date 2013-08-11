<?php
	require('../../config.php');
	header('Content-Type: text/html; charset=utf-8');
    require_once '../loginsystem.php';
	print '<pre>';
	$loginSystem = new LoginSystem();
	
	// 登入
	//*
	if ($loginSystem->login('Monshin', 'ILove4413!')) {
		print "登入成功\n";
	} else {
		print "登入失敗\n";
	}
	//*/
	
	// 取得登入者資料
	/*
	print_r($loginSystem->getLoginUserRank());
	print "\n";
	print_r($loginSystem->getLoginUserId());
	print "\n";
	print_r($loginSystem->getLoginUserData());
	//*/
	
	// 登出
	/*
	if ($loginSystem->logout()) {
		print "登出成功\n";
	} else {
		print "登出失敗\n";
	}
	//*/
?>
</pre>