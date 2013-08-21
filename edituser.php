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

// 載入Model
$userModel = new UserModel();

// 確認是否有正確的會員ID資料POST過來
$userId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
if (!$userId) {
	$authSystem->redirectHome();
}
$modelData = $userModel->getByAccountName($userId);
if (!$modelData) {
	$authSystem->redirectHome();
}

// 設定主版
$title = '編輯會員資料';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/edituser.php';
$addScripts = array();

// 設定頁面資料
$submitValue = '編輯';
$errors = array();
$infos = array();
$isPasswordEditable = False;
$isIdEditable = False;
$redirectUrl = filter_input(INPUT_POST, 'postfromurl', FILTER_VALIDATE_URL);
$permissions = UserRank::getPermissions();
$postUrl = $config['BASE_PATH'] . 'edituser.php';

// 處理編輯操作
$postData = filter_input_array(INPUT_POST, array('name' => FILTER_SANITIZE_STRING,
												 'identify' => FILTER_SANITIZE_STRING,
												 'sy' => FILTER_SANITIZE_STRING,
												 'mail' => FILTER_SANITIZE_STRING,
												 'phone' => FILTER_SANITIZE_STRING,
												 'Permission' => FILTER_SANITIZE_STRING,
												 'NY' => FILTER_VALIDATE_INT));
if ($postData and !in_array(NULL, $postData, True)) {
	if (in_array(False, $postData, True)) {
		$errors[] = '請確認資料填寫無誤';
	}
	// TODO: Validate
	if (!$errors) {
		if ($userModel->updateUserByAccountName($userId,
		 										$postData['name'],
		 										$postData['identify'],
		 										$postData['sy'],
		 										$postData['mail'],
		 										$postData['phone'],
		 										$postData['Permission'],
		 										$postData['NY']))
		{
			$infos[] = '帳號更新成功';
		} else {
			$errors[] = '帳號更新失敗';
		}
	}
	$modelData['name'] = $postData['name'];
	$modelData['identify'] = $postData['identify'];
	$modelData['sy'] = $postData['sy'];
	$modelData['mail'] = $postData['mail'];
	$modelData['phone'] = $postData['phone'];
	$modelData['Permission'] = $postData['Permission'];
	$modelData['NY'] = $postData['NY'];
}
require_once 'templates/layout.php';
// End of file