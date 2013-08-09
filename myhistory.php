<?php
require_once 'config.php';
// 驗證使用者是否登入
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserId = $loginSystem->getLoginUserId();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserId)) {
	$authSystem->redirectHome();
}

// 設定主版資料
$title = '我借的設備';
$navContentPath = $loginUserRank->isEqual(new UserRank(UserRank::ADMIN)) ? 'contents/nav_admin.php' : 'contents/nav_user.php';
$contentPath = 'contents/history.php';
$addScripts = array();

// 設定頁面資料
$lendModel = new LendModel();
$instanceModel = new InstanceModel();
$modelModel = new ModelModel();
$categoryModel = new CategoryModel();
$userModel = new UserModel();

$caption = $title;
$postLendBackUrl = '';
$operators = array('lendBack' => False);
$navigateUrl = $config['BASE_PATH'] . 'myhistory.php';

// 設定分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
$perpage = (int) $getData['perpage'];
$page = (int) $getData['page'];
$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($lendModel->getCount() / $perpage);
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];

// 載入Model資料
$lendsModelData = $lendModel->get($perpage, ($page - 1) * $perpage);
$lends = array();
foreach ($lendsModelData as $lendModelData) {
	$lend = array();
	$lend['lend'] = $lendModelData;
	
	$lend['instance'] = $instanceModel->getById($lend['lend']['instances_id']);
	
	$lend['model'] = $modelModel->getById($lend['instance']['model_id']);
	
	$lend['category'] = $categoryModel->getById($lend['model']['category_id']);
	
	$lend['user'] = $userModel->getByAccountName($lend['lend']['user_id']);
	
	$lends[] = $lend;
}

require_once 'templates/layout.php';
// End of file