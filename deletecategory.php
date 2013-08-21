<?php
require_once 'config.php';
// 驗證使用者是否為管理員
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}
$authSystem->redirectHomeWhenBelowRank($loginUserRank, new UserRank(UserRank::ADMIN));

// 設定主版
$title = '刪除設備';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/message.php';
$addScripts = array();

// 設定頁面資料
$caption = '刪除設備';
$infos = array();
$errors = array();

// 載入Model
$categoryModel = new CategoryModel();

// 讀取設備資料庫編號
$instanceId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$instanceId) {
	// 非法使用情形
	$authSystem->redirectHome();
}

// 讀取重導向位址
$redirectUrl = filter_input(INPUT_POST, 'postfromurl', FILTER_VALIDATE_URL);
if (!$redirectUrl) {
	// 非法使用情形
	$authSystem->redirectHome();
}

// 處理刪除動作
$result = $categoryModel->removeCategoryById($instanceId);
if ($result) {
	// 操作成功，重導向
	header('Location: ' . $redirectUrl);
	exit();
} else {
	$errors[] = '發生嚴重錯誤，請確認分類已無包含任何設備型號';
}

require_once 'templates/layout.php';
// End of file