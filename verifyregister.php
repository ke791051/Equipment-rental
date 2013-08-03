<?php
require_once 'config.php';
// 驗證使用者是否為管理者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();

// 設定主版資料
$title = '審核設備出借申請';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/verifyregister.php';
$addScripts = array();

// 設定頁面資料
$submitValue = '審核申請';
$postUrl = $config['BASE_PATH'] . 'verifyregister.php';
$errors = array();
$infos = array();

// 確認是否有正確的初始post資料
$postData = filter_input_array(INPUT_POST, array('id' => FILTER_VALIDATE_INT));
if (!is_array($postData) or in_array(False, $postData, True) or in_array(NULL, $postData, True)) {
	$authSystem->redirectHome();
}
$registerId = (int) $postData['id'];
$postData = filter_input_array(INPUT_POST, array('postfromurl' => FILTER_VALIDATE_URL, 'redirecturl' => FILTER_VALIDATE_URL));
$redirectUrl = NULL;
foreach ($postData as $url) {
	if ($url) {
		$redirectUrl = $url;
	}
}
if (is_null($redirectUrl)) {
	$authSystem->redirectHome();
}

// 處理審核申請資料
$postData = filter_input_array(INPUT_POST, array('expected_back_date' => FILTER_SANITIZE_STRING,
												 'note' => FILTER_SANITIZE_STRING));
if (!is_array($postData) or in_array(NULL, $postData, True)) {
	// pass
	//print_r($postData);
} else {
	// $ispass is null on false
	$ispass = (bool) filter_input(INPUT_POST, 'ispass', FILTER_VALIDATE_BOOLEAN);
	$registerModel = new RegisterModel();
	$result = $registerModel->verifyById($registerId, $loginSystem->getLoginUserId(), $ispass, $postData['note']);
	if ($result) {
		$infos[] = '申請審核完成';
		if ($ispass) {
			$registerModelData = $registerModel->getById($registerId);
			$lendModel = new LendModel();
			$lendResult = $lendModel->lend($registerModelData['user_id'], $registerModelData['instances_id'], new DateTime(), new DateTime($postData['expected_back_date']));
			if ($lendResult) {
				// TODO: redirect to historys
				$infos[] = '設備出借成功';
			} else {
				$errors[] = '設備出借失敗';
			}
		}
		if (!$errors) {
			header('Location: '. $config['BASE_PATH'] . 'manageregister.php');
			exit();
		}
	} else {
		$errors[] = '發生嚴重錯誤，請通知管理員';
	}
}
// 載入申請資料
$registerModel = new RegisterModel();
$registerModelData = $registerModel->getById($registerId);
if (!$registerModelData) {
	// should log
	$authSystem->redirectHome();
}
$register = array();
$register['register'] = $registerModelData;

$instanceModel = new InstanceModel();
$instance = $instanceModel->getById($registerModelData['instances_id']);
$register['instance'] = $instance;

$modelModel = new ModelModel();
$model = $modelModel->getById($instance['model_id']);
$register['model'] = $model;

$categoryModel = new CategoryModel();
$category = $categoryModel->getById($model['category_id']);
$register['category'] = $category;

$register['user'] = array('name' => 'Not Implemented', 'sy' => 'Not Implemented');

$expectedBackDate = new DateTime();
$expectedBackDate->add(new DateInterval('P1W'));
$expectedBackDate = $expectedBackDate->format(RegisterModel::DATE_FORMAT);
require_once 'templates/layout.php';
// End of file