<?php
// 申請出借設備
require_once 'config.php';
// 驗證使用者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}

// 設定主版資料
$title = '設備出借申請';
$navContentPath = 'contents/nav_user.php';
$contentPath = 'contents/instances.php';
$addScripts = array();

// 設定頁面資料
$caption = $title;
$navigateUrl = $config['BASE_PATH'] . 'register.php';
$postEditUrl = NULL;
$postDeleteUrl = NULL;
$postRegisterUrl = $config['BASE_PATH'] . 'register.php';
$postVerifyUrl = NULL;
$operators = array('edit' => False, 'delete' => False, 'register' => True, 'verify' => False);

// 載入Models
$instanceModel = new InstanceModel();

// 取得未被申請或未借出的設備
$categoryName = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);
if ($categoryName) {
	$instances = $instanceModel->getInstancesCanBeRegisteredByCategoryName($categoryName);
	$instancesCount = count($instances);
} else {
	$instances = $instanceModel->getInstancesCanBeRegistered();
	$instancesCount = $instanceModel->getCount();
}
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
if (!is_array($getData) or in_array(FALSE, $getData, True) ) {
	$perpage = $config['DEFAULT_PERPAGE'];
	$page = $config['DEFAULT_PAGE'];
} else {
	$perpage = (int) $getData['perpage'];
	$page = (int) $getData['page'];
}
$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($instancesCount / $perpage);
$totalPages = $totalPages == 0 ? 1 : $totalPages;
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];
$instances = array_slice($instances, ($page - 1) * $perpage, $perpage);

// 處理申請資料
$postData = filter_input_array(INPUT_POST, array('id' => FILTER_VALIDATE_INT,
												 'postfromurl' => FILTER_SANITIZE_URL));
if (!is_array($postData) or in_array(FALSE, $postData, True)) {
	// 程式寫錯或有人亂傳資料
	// can log
} else if (in_array(NULL, $postData, True)) {
	// program has error or someone post marvelous data
	// can log
} else {
	// 重導向至message，避免重POST
	$contentPath = 'contents/message.php';
	$redirectUrl = $postData['postfromurl'];
	$infos = array();
	$errors = array();
	// TODO 驗證
	// 驗證要申請的設備是否可被申請
	// 重POST或惡意資料會造成以上問題
	$registerModel = new RegisterModel();
	$registerResult = $registerModel->register($loginSystem->getLoginUserId(), $postData['id']);
	if ($registerResult) {
		$infos[] = '設備申請成功';
		header('Location: ' . $config['BASE_PATH'] . 'myregisters.php');
		exit();
	} else {
		$errors[] = '設備申請失敗';
	}
}

require_once 'templates/layout.php';
// End of file