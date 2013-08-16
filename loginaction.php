<?php
require_once 'config.php';

$loginSystem = new LoginSystem();
$authSystem = new AuthSystem();

// 確認POST傳來的帳號密碼資料是否正確
$postData = filter_input_array(INPUT_POST, array('id' => FILTER_SANITIZE_STRING,
												 'password' => FILTER_SANITIZE_STRING));
if (!$postData or in_array(NULL, $postData, True) or in_array(False, $postData, True)) {
	//$authSystem->redirectHome();
	return;
} 

if ($loginSystem->login($postData['id'], $postData['password'])) {
	$loginUserRank = $loginSystem->getLoginUserRank();
	// 依照使用者層級導入至正確的頁面
	if ($loginUserRank->isEqual(new UserRank(UserRank::ADMIN))) {
		header('Location: ' . $config['DEFAULT_ADMIN_HOME']);
		return;
	} else {
		header('Location: ' . $config['DEFAULT_USER_HOME']);
		return;
	}
}
// 登入失敗即顯示錯誤訊息
else {
	// 設定主版資料
	$title = '登入失敗';
	$navContentPath = 'contents/nav_guest.php';
	$contentPath = 'contents/message.php';
	$addScripts = array();
	
	// 設定頁面資料
	$caption = $title;
	$infos = array();
	$errors = array();
	$redirectUrl = NULL;
	$errors[] = '帳號或密碼輸入錯誤';
	
	require_once 'templates/layout.php';
}
// End of file
