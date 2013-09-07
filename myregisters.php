<?php
require_once 'config.php';
// 檢查使用者是否登入
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserId = $loginSystem->getLoginUserId();
if (is_null($loginUserId)) {
	$authSystem->redirectHome();
}

// 設定主版資料
$title = '我的申請紀錄';
$loginUserRank = $loginSystem->getLoginUserRank();
$navContentPath = $loginUserRank->isEqual(new UserRank(UserRank::ADMIN)) ? 'contents/nav_admin.php' : 'contents/nav_user.php';
$contentPath = 'contents/registers.php';
$addScripts = array('<link rel="stylesheet" href="css/registers.css" type="text/css" charset="utf-8" />',
					'<script src="jquery/table.js" type="text/javascript"></script>',
					'<link rel="stylesheet" href="css/table.css" type="text/css" charset="utf-8" />',
					'<link rel="stylesheet" href="css/Manage_Page_layout.css" type="text/css" charset="utf-8" />');
					
// 設定頁面資料
$caption = $title;
$navigateUrl = $config['BASE_PATH'] . 'myregisters.php';
$pagination = new Pagination();
$pagination->setNavigateUrl($navigateUrl);
$pagination->setPageRangeNum(10);
$operators = array('verify' => False);
// 載入Model
$registerModel = new RegisterModel();
$instanceModel = new InstanceModel();
$modelModel = new ModelModel();
$categoryModel = new CategoryModel();
$userModel = new UserModel();

// 計算使用者申請紀錄總個數
$modelsData = $registerModel->getByUserId($loginUserId);
$totalRows = count($modelsData);

// 設定分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
$page = (int) $getData['page'];
$perpage = (int) $getData['perpage'];
$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($totalRows / $perpage);
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];
$pagination->setCurrentPage($page);
$pagination->setPerpage($perpage);
$pagination->setTotalPages($totalPages);

// 設定Model資料
$modelsData = array_slice($modelsData, ($page - 1) * $perpage, $perpage);
$registers = array();
foreach ($modelsData as $register) {
	$modelData = array();
	
	$modelData['register'] = $register;
	
	$modelData['instance'] = $instanceModel->getById($modelData['register']['instances_id']);
	
	$modelData['model'] = $modelModel->getById($modelData['instance']['model_id']);
	
	$modelData['category'] = $categoryModel->getById($modelData['model']['category_id']);
	
	$modelData['user'] = $userModel->getByAccountName($modelData['register']['user_id']);
	
	$modelData['verifyuser'] = $userModel->getByAccountName($modelData['register']['verifyuser_id']); 
	
	$registers[] = $modelData;
}

require_once 'templates/layout.php';
// End of file