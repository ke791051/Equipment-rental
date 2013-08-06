<?php
    require_once 'config.php';
	
	// 驗證使用者權限
	$authSystem = new AuthSystem();
	$loginSystem = new LoginSystem();
	$loginUserRank = $loginSystem->getLoginUserRank();
	// 未登入
	if (is_null($loginUserRank)) {
		$authSystem->show404();
		exit();
	}
	$adminUserRank = new UserRank(UserRank::ADMIN);
	$authSystem->redirectHomeWhenBelowRank($loginUserRank, $adminUserRank);
	
	// 設定主板
	$title = '新增設備分類';
	$navContentPath = 'contents/nav_admin.php';
	$contentPath = 'contents/editcategory.php';
	$addScripts = array();
	
	// 設定頁面內容
	$modelData = array('id' => '',
					   'name' => '',
					   'category_id' => '');
	$categoryName = '';
	$submitValue = '新增分類';
	$postUrl = 'newcategory.php';
	$errors = array();
	$infos = array();
	$redirectUrl = NULL;

	// 處理使用者上傳資料
	if (isset($_POST['name'])) {
		$categoryName = $_POST['name'];
		$validator = new CategoryValidator();
		$errors = $validator->validateForAdd($categoryName);
		// 資料驗證成功，開始新增資料
		if (!$errors) {
			$categoryModel = new CategoryModel();
			if ($categoryModel->addCategory($categoryName)) {
				$infos[] = '分類新增成功';
				$categoryName = '';
			} else {
				$errors[] = '發生不知名錯誤，請聯絡管理者';
			}
		}
		$modelData['name'] = $categoryName;
	}
	
	// 載入主板
	require_once 'templates/layout.php';
// End of file