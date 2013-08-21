<?php
require_once 'config.php';

// 確認使用者是否登入
$loginSystem = new LoginSystem();
$loginUserId = $loginSystem->getLoginUserId();

// 登入即重導向至mylends
if ($loginUserId) {
	header('Location: ' . $config['BASE_PATH'] . 'myhistory.php');
	exit();
}

// 設定主版資料
$title = '我的設備借用紀錄';
$navContentPath = 'contents/nav_guest.php';
$contentPath = 'contents/guestlogin.php';
$addScripts = array();

// 設定頁面資料
$caption = $title;
$postUrl = $config['BASE_PATH'] . 'guestlends.php';
$errors = array();
$infos = array();
// TODO fill full user model data key
$modelData = array('sy' => NULL,
				   'name' => NULL);

// 接收使用者資料並登入
$postData = filter_input_array(INPUT_POST, array('sy' => FILTER_SANITIZE_STRING,
												 'name' => FILTER_SANITIZE_STRING));
if ($postData and !in_array(NULL, $postData, True)) {
	$token = hash('sha256', $postData['sy'] . $postData['name']);
	if ($loginSystem->login($token, $token)) {
		header('Location: ' . $config['BASE_PATH'] . 'myhistory.php');
		exit();
	} else {
		$infos[] = '查無申請紀錄';
		$modelData['sy'] = $postData['sy'];
		$modelData['name'] = $postData['name'];
	}
}

require_once 'templates/layout.php';

// End of file	