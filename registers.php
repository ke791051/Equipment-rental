<?php
// 申請出借設備
require_once 'config.php';
// 驗證使用者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
	
// 設定主版資料
$title = '設備出借申請';
$navContentPath = 'contents/nav_guest.php';
$contentPath = 'contents/picturedinstances.php';
$addScripts = array();

// 設定頁面資料
$caption = $title;
$navigateUrl = $config['BASE_PATH'] . 'registers.php';
$postRegisterUrl = $config['BASE_PATH'] . 'register.php';
$operators = array('register' => True);

// 載入Models
$instanceModel = new InstanceModel();
$modelModel = new ModelModel();
$categoryModel = new CategoryModel();
$filemanagement = new FileManagement();

// 取得未被申請或未借出的設備
$categoryName = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);
if ($categoryName) {
	$instances = $instanceModel->getInstancesCanBeRegisteredByCategoryName($categoryName);
} else {
	$instances = $instanceModel->getInstancesCanBeRegistered();
}

// 設定ModelData
$modelData = array();
foreach ($instances as $instance) {
	$modelId = $instance['model_id'];
	
	if (!isset($modelData[$modelId])) {
		$modelData[$modelId]['model'] = $modelModel->getById($modelId);
		$modelData[$modelId]['category'] = $categoryModel->getById($modelData[$modelId]['model']['category_id']);
		$modelImageIds = $modelModel->getModelImagesById($modelId);
		if ($modelImageIds) {
			$modelImageId = $modelImageIds[0][0];
			$modelImageData = $filemanagement->get_file($modelImageId);
			$modelData[$modelId]['model_image'] = array('name' => $modelImageData[0], 'path' => $modelImageData[1]);
		} else {
			$modelData[$modelId]['model_image'] = array('name' => 'No Image', 'path' => '');
		} 
		$modelData[$modelId]['instances'] = array();
	}
	
	$modelData[$modelId]['instances'][] = $instance;
}
$categories = $categoryModel->get();

// 設定分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
if (!is_array($getData) or in_array(FALSE, $getData, True) ) {
	$perpage = $config['DEFAULT_PERPAGE'];
	$page = $config['DEFAULT_PAGE'];
} else {
	$perpage = (int) $getData['perpage'];
	$page = (int) $getData['page'];
}
$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil(count($modelData) / $perpage);
$totalPages = $totalPages == 0 ? 1 : $totalPages;
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];
$modelData = array_slice($modelData, ($page - 1) * $perpage, $perpage);

require_once 'templates/layout.php';
// End of file