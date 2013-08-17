<?php
require_once 'config.php';
// 驗證使用者是否為管理者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserId = $loginSystem->getLoginUserId();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}
$authSystem->redirectHomeWhenBelowRank($loginUserRank, new UserRank(UserRank::ADMIN));

// 設定主版資料
$title = '設備歸還';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/lendback.php';
$addScripts = array();

// 設定頁面資料
$submitValue = $title;
$postBackUrl = $config['BASE_PATH'] . 'lendback.php';
$redirectUrl = filter_input(INPUT_POST, 'postfromurl', FILTER_VALIDATE_URL);
if (!$redirectUrl) {
	$redirectUrl = filter_input(INPUT_POST, 'redirecturl', FILTER_VALIDATE_URL);
}
// 載入Model
$lendModel = new LendModel();
$instanceModel = new InstanceModel();
$modelModel = new ModelModel();
$categoryModel = new CategoryModel();

// 設定要處理的lend資料
$lendId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$lendId) {
	$authSystem->redirectHome();
}
// 處理歸還資料
$postData = filter_input_array(INPUT_POST, array('lendbackdate' => FILTER_SANITIZE_STRING,
												 'note' => FILTER_SANITIZE_STRING));
if (!in_array(NULL, $postData, True) and !in_array(FALSE, $postData, True)) {
	$lendBackDate = new DateTime($postData['lendbackdate']);
	$note = $postData['note'];
	try {
		$backDate = new DateTime($postData['lendbackdate']);
		if ($lendModel->backById($lendId, $loginUserId, $backDate, $note)) {
			header('Location: ' . $redirectUrl);
			exit();
		} else {
			// show 505 or error message
			// log
			// print $lendModel->getStatementErrorMessage();
		}
	} catch (Exception $e) {
		$errors[] = '輸入的日期格式不正確';
	}
	
}
// 設定Model資料
$lend = array();
$lend['lend'] = $lendModel->getById($lendId);
$lend['instance'] = $instanceModel->getById($lend['lend']['instances_id']);
$lend['model'] = $modelModel->getById($lend['instance']['model_id']);
$lend['category'] = $categoryModel->getById($lend['model']['category_id']);
$lend['user'] = array('name' => 'Not Implemented', 'sy' => 'Not Implemented');
$lendBackDate = new DateTime();
$lendBackDate = $lendBackDate->format(LendModel::DATE_FORMAT);

require_once 'templates/layout.php';
// End of file