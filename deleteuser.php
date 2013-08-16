<?php
require_once 'config.php';

// 驗證使用者是否為管理者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}
$authSystem->redirectHomeWhenBelowRank($loginUserRank, new UserRank(UserRank::ADMIN));

// 確認POST傳來的使用者資料是否正確
$userId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
if (!$userId) {
	$authSystem->redirectHome();
}

// 確認POST傳來重導向資料是否正確
$redirectUrl = filter_input(INPUT_POST, 'postfromurl', FILTER_VALIDATE_URL);
if (!$redirectUrl) {
	$authSystem->redirectHome();
}

// 載入Models
$userModel = new UserModel();
// 刪除成功即重導向
if ($userModel->removeByAccountName($userId)) {
	header('Location: ' . $redirectUrl);
}
// 刪除失敗則顯示訊息
else {
	// 設定主版
	$title = '刪除會員';
	$navContentPath = 'contents/nav_admin.php';
	$contentPath = 'contents/message.php';
	$addScripts = array();
	
	// 設定頁面資料
	$errors = array();
	$infos = array();
	$caption = $title;
	$redirectUrl = $redirectUrl;
	$errors[] = '會員刪除失敗';
	
	require_once 'templates/layout.php';
}

// End of file