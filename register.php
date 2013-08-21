<?php
require_once 'config.php';

$authSystem = new AuthSystem();
// 接收要申請的設備編號
$instanceId = NULL;
$postIdData = filter_input_array(INPUT_POST, array('id' => FILTER_SANITIZE_STRING,
												   'instance_id' => FILTER_SANITIZE_STRING));
foreach ($postIdData as $postId) {
	if ($postId) {
		$instanceId = $postId;
	}
}
if (!$instanceId) {
	$authSystem->redirectHome();
}

// 載入Model
$instanceModel = new InstanceModel();
$userModel = new UserModel();
$registerModel = new RegisterModel();

// 設定重導向位置
$redirectUrl = NULL;
$postUrlData = filter_input_array(INPUT_POST, array('postfromurl' => FILTER_VALIDATE_URL,
													'redirecturl' => FILTER_VALIDATE_URL));
foreach ($postUrlData as $postUrl) {
	if ($postUrl) {
		$redirectUrl = $postUrl;
	}
}
$redirectUrl = $postUrl ? $postUrl : $config['BASE_PATH'] . 'registers.php';

// 接收申請者資料
$errors = array();
$infos = array();
$user = NULL;
$postUserData = filter_input_array(INPUT_POST, array('name' => FILTER_SANITIZE_STRING,
													 'identify' => FILTER_SANITIZE_STRING,
													 'sy' => FILTER_SANITIZE_STRING,
													 'phone' => FILTER_SANITIZE_STRING));									 
if ($postUserData and !in_array(NULL, $postUserData, True)) {
	if (in_array('', array_map(function($value) { return trim($value); } ,$postUserData))) {
		$errors[] = '請填入必填欄位';	
	}
	$accountName = hash('sha256', $postUserData['sy'] . $postUserData['identify'] . $postUserData['name'] . $postUserData['phone']);
	$user = $userModel->getByAccountName($accountName);
	if (!$user and !$errors) {
		$addResult = $userModel->addUser($accountName,
								 		 $accountName,
										 $postUserData['name'],
										 $postUserData['identify'],
										 $postUserData['sy'],
										 NULL,
										 $postUserData['phone'],
										 UserRank::STUDENT,
										 True);
		if (!$addResult) {
			$errors[] = '目前無法申請設備，請稍候重試';
			$errors[] = $userModel->getStatementErrorMessage();
		} else {
			$user = $userModel->getByAccountName($accountName);
		}
	}
	if ($errors) {
		// 有錯誤，不做事
	}
	else if ($user and $user['NY'] != False) {
		$registerResult = $registerModel->register($user['id'], $instanceId);	
		if ($registerResult) {
			$loginSystem = new LoginSystem();
			$loginSystem->login($accountName, $accountName);
			header('Location: ' . $config['BASE_PATH'] . 'guestregisters.php');
			exit();
		} else {
			$errors[] = '申請失敗，此設備可能被搶先申請了';
		}
	} else {
		$errors[] = '資料庫罷工中，請稍候重試';
	}
}

// 設定主版資料
$title = '申請設備';
$navContentPath = 'contents/nav_guest.php';
$contentPath = 'contents/register.php';
$addScripts = array();

// 設定頁面資料
$caption = $title;
$postUrl = $config['BASE_PATH'] . 'register.php';
$redirectUrl = $redirectUrl;
$modelData = array();

$modelData['instance'] = $instanceModel->getById($instanceId);
$modelData['user'] = $user;

require_once 'templates/layout.php';
// End of file