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
$addScripts = array();

// 載入Model
$userModel = new UserModel();

// 設定頁面資料
$caption = $title;
$navigateUrl = $config['BASE_PATH'] . 'manageusers.php';
$postEditUrl = $config['BASE_PATH'] . 'edituser.php';
$postDeleteUrl = $config['BASE_PATH'] . 'deleteuser.php';
$operators = array('edit' => True, 'delete' => True);
// 設定分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
$perpage = $getData['perpage'];
$page = $getData['page'];
$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($userModel->getCount() / $perpage);
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];
$modelsData = $userModel->get($perpage, ($page - 1) * $perpage);

require_once 'templates/layout.php';
// End of file