<?php
	require_once 'config.php';
	
    // 驗證使用者
    $authSystem = new AuthSystem();
	$loginSystem = new LoginSystem();
	$loginUserRank = $loginSystem->getLoginUserRank();
	if (is_null($loginUserRank)) {
		$authSystem->redirectHome();
		exit();
	}
	$adminUserRank = new UserRank(UserRank::ADMIN);
	$authSystem->redirectHomeWhenBelowRank($loginUserRank, $adminUserRank);
	
    // 設定主版
    $title = '編輯設備分類';
	$navContentPath = 'contents/nav_admin.php';
	$contentPath = 'contents/editcategory.php';
	$addScripts = array();
	
    // 設定頁面內容
    if (is_null($_POST['id'])) {
    	$authSystem->redirectHome();
		exit();
    }
    $id = trim($_POST['id']);
	$categoryModel = new CategoryModel();
	$modelData = $categoryModel->getById($id);
	if (is_null($modelData)) {
		// or show message content
		$authSystem->redirectHome();
		exit();
	}
	$submitValue = '更新設備分類';
	$postUrl = 'editcategory.php';
	$errors = array();
	$infos = array();
	if (isset($_POST['postfromurl'])) {
		$redirectUrl = $_POST['postfromurl'];
	} else if (isset($_POST['redirecturl'])) {
		$redirectUrl = $_POST['redirecturl'];
	}
	else {
		$redirectUrl = $config['BASE_PATH'] . 'managecategories.php';
	}
	
    // 處理設備分類編輯資料
    if (isset($_POST['name'])) {
    	$name = trim($_POST['name']);
		$validator = new CategoryValidator();
		$errors = array_merge($errors, $validator->validateForUpdateById($id, $name));
		if (!$errors) {
			if ($categoryModel->updateCategoryById($id, $name)) {
				$infos[] = '設備分類更新成功';
				$modelData['name'] = $name;
			} else {
				$errors[] = '發生不知名錯誤，請通知管理員';
			}
		}
    }
	
    require_once 'templates/layout.php'; 
?>