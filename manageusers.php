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

// 設定主版資料
$title = '管理使用者';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/users.php';
$addScripts = array('<link rel="stylesheet" href="css/history.css" type="text/css" charset="utf-8" />',
					'<script src="jquery/table.js" type="text/javascript"></script>',
					'<link rel="stylesheet" href="css/table.css" type="text/css" charset="utf-8" />',
					'<link rel="stylesheet" href="css/Manage_Page_layout.css" type="text/css" charset="utf-8" />');

// 載入Model
$userModel = new UserModel();

// 設定頁面資料
$caption = $title;
$navigateUrl = $config['BASE_PATH'] . 'manageusers.php';
$postEditUrl = $config['BASE_PATH'] . 'edituser.php';
$postDeleteUrl = $config['BASE_PATH'] . 'deleteuser.php';
$postEditPasswordUrl = $config['BASE_PATH'] . 'editpassword.php';
$getSearchUrl = $config['BASE_PATH'] . 'manageusers.php';
$pagination = new Pagination();
$pagination->setNavigateUrl($navigateUrl);
$pagination->setPageRangeNum(7);
$operators = array('edit' => True, 'delete' => True, 'editpassword' => True);

// 設定分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
if (!$getData or in_array(FALSE, $getData, True)) {
	$perpage = $config['DEFAULT_PERPAGE'];
	$page = $config['DEFAULT_PAGE'];
} else {
	$perpage = (int) $getData['perpage'];
	$page = (int) $getData['page'];
}

// 處理篩選資料
$searchUserData = filter_input(INPUT_GET, 'search_identify', FILTER_SANITIZE_STRING);
if ($searchUserData) {
	$modelsData = $userModel->getByIdentify($searchUserData);
	$totalRows = count($searchUserData);
	$pagination->setQueryString('search_identify', $searchUserData);
} else {
	$totalRows = $userModel->getCount();
}
$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($totalRows / $perpage);
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];
if ($searchUserData) {
	$modelsData = array_slice($modelsData, ($page - 1) * $perpage, $perpage);
} else {
	$modelsData = $userModel->get($perpage, ($page - 1) * $perpage);
}
$pagination->setCurrentPage($page);
$pagination->setPerpage($perpage);
$pagination->setTotalPages($totalPages);

require_once 'templates/layout.php';
// End of file