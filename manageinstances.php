<?php
require_once 'config.php';
// 驗證使用者是否為管理者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
	exit();
}
$adminUserRank = new UserRank(UserRank::ADMIN);
$authSystem->redirectHomeWhenBelowRank($loginUserRank, $adminUserRank);

// 設定主版資料
$title = '設備管理';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/instances.php';
$addScripts = array();

// 載入頁面資料
$caption = $title;
$instanceModel = new InstanceModel();

$navigateUrl = $config['BASE_PATH'] . 'manageinstances.php';
$postEditUrl = $config['BASE_PATH'] . 'editinstance.php';
$postDeleteUrl = $config['BASE_PATH'] . 'deleteinstance.php';
$postRegisterUrl = $config['BASE_PATH'] . 'register.php';
$postVerifyUrl = $config['BASE_PATH'] . 'verify.php';
$operators = array('edit' => True, 'delete' => True, 'register' => False, 'verify' => True);

// 處理分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
$page = (int) $getData['page'];
$perpage = (int) $getData['perpage'];

$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($instanceModel->getCount() / $perpage);
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];
$instances = $instanceModel->get($perpage, ($page - 1) * $perpage);
//print $instanceModel->getStatementErrorMessage();
require_once 'templates/layout.php';
?>