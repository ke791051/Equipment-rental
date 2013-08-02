<?php
require_once 'config.php';

// 驗證使用者是否為管理者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if ($loginUserRank) {
	$authSystem->redirectHome();
}
$authSystem->redirectHomeWhenBelowRank($loginUserRank, new UserRank(UserRank::ADMIN));

// 設定主版資料
$title = '審核管理';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/registers.php';
$addScripts = array();

// 設定頁面資料
$caption = $title;
$navigateUrl = $config['BASE_PATH'] . 'manageregisters.php';
$postVerifyUrl = $config['BASE_PATH'] . 'verifyregister.php';
$operators = array('verify' => True);

// 載入模組
$registerModel = new RegisterModel();
$modelModel = new ModelModel();
$categoryModel = new CategoryModel();
$instanceModel = new InstanceModel();

// 處理分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
if (!$getData or !in_array(FALSE, $getData, True)) {
	$perpage = $config['DEFAULT_PERPAGE'];
	$page = $config['DEFAULT_PAGE'];
} else {
	$perpage = (int) $getData['perpage'];
	$page = (int) $getData['page'];
}
$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($registerModel->getCount() / $perpage);
$totalPages = $totalPages == 0 ? 1 : $totalPages;
$page = $page > 0 and $page <= $totalPages ? $page : $config['DEFAULT_PAGE'];
$registersModelData = $registerModel->get($perpage, ($page - 1) * $perpage);
// 建立registers資料
$registers = array();
foreach ($registersModelData as $registerModelData) {
	$registerData = array();
	$registerData['register'] = $registerModelData;

	$instanceData = $instanceModel->getById($registerModelData['instances_id']);
	$registerData['instance'] = $instanceData;
	
	$modelData = $modelModel->getById($instanceData['model_id']);
	$registerData['model'] = $modelData;
	
	$categoryData = $categoryModel->getById($modelData['category_id']);
	$registerData['category'] = $categoryData;
	
	// TODO: UserModel
	$registerData['user'] = array('name' => 'UserModel not implemented');
	
	$registers[] = $registerData;
}

require_once 'templates/layout.php';
// End of file