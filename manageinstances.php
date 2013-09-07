<?php
require_once 'config.php';
// 驗證使用者是否為管理者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}
$adminUserRank = new UserRank(UserRank::ADMIN);
$authSystem->redirectHomeWhenBelowRank($loginUserRank, $adminUserRank);

// 設定主版資料
$title = '設備管理';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/instances.php';
$addScripts = array('<link rel="stylesheet" href="css/instances.css" type="text/css" charset="utf-8" />',
					'<script src="jquery/table.js" type="text/javascript"></script>',
					'<link rel="stylesheet" href="css/table.css" type="text/css" charset="utf-8" />',
					'<link rel="stylesheet" href="css/Manage_Page_layout.css" type="text/css" charset="utf-8" />');

// 設定頁面資料
$caption = $title;
$instanceModel = new InstanceModel();

$postEditUrl = $config['BASE_PATH'] . 'editinstance.php';
$postDeleteUrl = $config['BASE_PATH'] . 'deleteinstance.php';
$postRegisterUrl = $config['BASE_PATH'] . 'register.php';
$postVerifyUrl = $config['BASE_PATH'] . 'verify.php';
$getSearchUrl = $config['BASE_PATH'] . 'manageinstances.php';
$pagination = new Pagination();
$pagination->setNavigateUrl($config['BASE_PATH'] . 'manageinstances.php');
$pagination->setPageRangeNum(7);
$operators = array('edit' => True, 'delete' => True, 'register' => False, 'verify' => False);

// 處理分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
$page = (int) $getData['page'];
$perpage = (int) $getData['perpage'];

// 處理篩選資料
$searchIdentifyData = filter_input(INPUT_GET, 'search_identify', FILTER_SANITIZE_STRING);
if ($searchIdentifyData) {
	$instance = $instanceModel->getByIdentify($searchIdentifyData);
	$instances = $instance ? array($instance) : array();
	$totalRows = count($instances);
} else {
	$totalRows = $instanceModel->getCount();
}

$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($totalRows / $perpage);
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];
$pagination->setTotalPages($totalPages);
$pagination->setPerpage($perpage);
$pagination->setCurrentPage($page);
if ($searchIdentifyData) {
	$instances = $instances;
} else {
	$instances = $instanceModel->get($perpage, ($page - 1) * $perpage);
}
//print $instanceModel->getStatementErrorMessage();
require_once 'templates/layout.php';
?>