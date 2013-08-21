<?php
// 新增使用者
require_once 'config.php';

// 驗證使用者是否為管理者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}
$authSystem->redirectHomeWhenBelowRank($loginUserRank, new UserRank(UserRank::ADMIN));

// 設定主版資料
$title = '新增使用者';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/edituser.php';
$addScripts = array();

// 載入Model
$userModel = new UserModel();

// 設定頁面資料
$submitValue = $title;
$redirectUrl = NULL;
$errors = array();
$infos = array();
$permissions = UserRank::getPermissions();
$isPasswordEditable = True;
$isIdEditable = True;
$postUrl = $config['BASE_PATH'] . 'newuser.php';

// 設定空白ModelData
$modelData = array('id' => NULL,
				   'name' => NULL,
				   'pw' => NULL,
				   'identify' => NULL,
				   'sy' => NULL,
				   'mail' => NULL,
				   'phone' => NULL,
				   'Permission' => NULL,
				   'NY' => NULL);
				   
// 處理傳來的使用者資料
$postData = filter_input_array(INPUT_POST, array('id' => FILTER_SANITIZE_STRING,
												 'name' => FILTER_SANITIZE_STRING,
												 'pw' => FILTER_SANITIZE_STRING,
												 'identify' => FILTER_SANITIZE_STRING,
												 'sy' => FILTER_SANITIZE_STRING,
												 'mail' => FILTER_SANITIZE_STRING,
												 'phone' => FILTER_SANITIZE_STRING,
												 'Permission' => FILTER_SANITIZE_STRING,
												 'NY' => FILTER_VALIDATE_INT));
if ($postData and !in_array(NULL, $postData, True) and !in_array(False, $postData, True)) {
	$isMailValid = filter_var($postData['mail'], FILTER_VALIDATE_EMAIL);
	if (!$isMailValid) {
		$errors[] = '請確認電子郵件格式是否輸入正確';
	}
	// TODO: 驗證
	// Quick validate
	if ($userModel->getByAccountName($postData['id'])) {
		$errors[] = '此帳號名稱已被使用';
	}
	if (!$errors) {
		if ($userModel->addUser($postData['id'],
							    $postData['pw'],
							    $postData['name'],
							    $postData['identify'],
							    $postData['sy'],
							    $postData['mail'],
							    $postData['phone'],
							    $postData['Permission'],
								$postData['NY']))
		{
			$infos[] = '會員新增成功';
		} else {
			$errors[] = '會員新增失敗';
		}
	} 
	// 如果新增會員操作不成功
	if ($errors) {
		// 回填資料
		$modelData['id'] = $postData['id'];
		$modelData['name'] = $postData['name'];
		$modelData['sy'] = $postData['sy'];
		$modelData['mail'] = $postData['mail'];
		$modelData['phone'] = $postData['phone'];
		$modelData['Permission'] = $postData['Permission'];
		$modelData['NY'] = $postData['NY'];
	}
}

require_once 'templates/layout.php';
