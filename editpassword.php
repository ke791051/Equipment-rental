<?php
require_once 'config.php';

// 驗證使用者是否為管理者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
	return;
}
$authSystem->redirectHomeWhenBelowRank($loginUserRank, new UserRank(UserRank::ADMIN));

// 設定主版資料
$title = '設定新密碼';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/editpassword.php';
$addScripts = array();

// 接收使用者編號
$postEditUserId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
if (!$postEditUserId) {
	$authSystem->redirectHome();
	return;
}

// 載入Model
$userModel = new UserModel();

// 接收新密碼
$errors = array();
$infos = array();
$postPasswordsData = filter_input_array(INPUT_POST, array('password' => FILTER_SANITIZE_STRING,
														  'verify_password' => FILTER_SANITIZE_STRING));
if ($postPasswordsData and !in_array(NULL, $postPasswordsData, True)) {
	if ($postPasswordsData['password'] != $postPasswordsData['verify_password']) {
		$errors[] = '兩次輸入的密碼不一致';
	}
	if (!$errors) {
		$result = $userModel->updateUserPasswordByAccountName($postEditUserId, $postPasswordsData['password']);
		if ($result) {
			$infos[] = '密碼更新成功';
		} else {
			$errors[] = '資料庫發生錯誤，請稍候重試';
		}
	}
}

// 設定重導向位置
$postUrls = filter_input_array(INPUT_POST, array('postfromurl' => FILTER_VALIDATE_URL,
												 'redirecturl' => FILTER_VALIDATE_URL));
$redirectUrl = NULL;
foreach ($postUrls as $postUrl) {
	if ($postUrl) {
		$redirectUrl = $postUrl;
		break;
	}
}

// 設定頁面資料
$modelData = $userModel->getByAccountName($postEditUserId);
$submitValue = $title;
$errors = $errors;
$infos = $infos;
$postUrl = $config['BASE_PATH'] . 'editpassword.php';
$redirectUrl = $redirectUrl;

require_once 'templates/layout.php';
// End of file