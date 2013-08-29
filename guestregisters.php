<?php
require_once 'config.php';

// 確認使用者是否登入
$loginSystem = new LoginSystem();
$loginUserId = $loginSystem->getLoginUserId();

// 登入即重導向至myregisters
if ($loginUserId) {
	header('Location: ' . $config['BASE_PATH'] . 'myregisters.php');
	exit();
}

// 設定主版資料
$title = '查詢設備申請狀態';
$navContentPath = 'contents/nav_guest.php';
$contentPath = 'contents/guestlogin.php';
$addScripts = array('<script src="jquery/validate.js" type="text/javascript"></script>',
					'<link rel="stylesheet" href="css/guestlogin.css" type="text/css" charset="utf-8" />',
					'<link rel="stylesheet" href="css/nav_guest.css" type="text/css" charset="utf-8" />');

// 設定頁面資料
$caption = $title;
$postUrl = $config['BASE_PATH'] . 'guestregisters.php';
$errors = array();
$infos = array();
// TODO fill full user model data key
$modelData = array('sy' => NULL,
				   'identify' => NULL,
				   'name' => NULL,
				   'phone' => NULL);

// 接收使用者資料並登入
$postData = filter_input_array(INPUT_POST, array('sy' => FILTER_SANITIZE_STRING,
												 'identify' => FILTER_SANITIZE_STRING,
												 'name' => FILTER_SANITIZE_STRING,
												 'phone' => FILTER_SANITIZE_STRING));
if ($postData and !in_array(NULL, $postData, True)) {
	$token = hash('sha256', $postData['sy'] . $postData['identify'] . $postData['name'] . $postData['phone']);
	if ($loginSystem->login($token, $token)) {
		header('Location: ' . $config['BASE_PATH'] . 'myregisters.php');
		exit();
	} else {
		$infos[] = '查無申請紀錄';
		$modelData['sy'] = $postData['sy'];
		$modelData['identify'] = $postData['identify'];
		$ModelData['name'] = $postData['name'];
		$modelData['phone'] = $postData['phone'];
	}
}

require_once 'templates/layout.php';

// End of file	