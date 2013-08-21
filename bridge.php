<?php
require_once 'config.php';

// 確認使用者是否為管理者
$loginSystem = new LoginSystem();
$authSystem = new AuthSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}
$authSystem->redirectHomeWhenBelowRank($loginUserRank, new UserRank(UserRank::ADMIN));

// 設定主版資料
$title = '匯入設備資料';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/bridge.php';
$addScripts = array();

// 設定頁面資料
$caption = $title;
$errors = array();
$infos = array();
$postUrl = $config['BASE_PATH'] . 'bridge.php';

// 處理上傳檔案
if (isset($_FILES['excelfile'])) {
	if ($_FILES['excelfile']['error'] != 0) {
		$errors[] = '檔案大小超過限制或未上傳，請再試一次';
	} 
	if (!$errors) {
		$instancesImporter = new InstancesImporter();
		$isReplace = filter_input(INPUT_POST, 'isreplace', FILTER_VALIDATE_BOOLEAN);
		$action = $isReplace ? InstancesImporter::ON_DUPLICATE_REPLACE : InstancesImporter::ON_DUPLICATE_IGNORE;
		$hasTitle = filter_input(INPUT_POST, 'hastitle', FILTER_VALIDATE_BOOLEAN);
		$importErrors = $instancesImporter->import($_FILES['excelfile']['tmp_name'], $hasTitle, $action);
		$errors = array_merge($errors, $importErrors);
	}
	if (!$errors) {
		$infos[] = '設備資料匯入成功';
	}
}

require_once 'templates/layout.php';
// End of file