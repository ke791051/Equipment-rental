<?php
	require_once 'config.php';
    // 驗證使用者權限
    $authSystem = new AuthSystem();
	$loginSystem = new LoginSystem();
	
	$loginUserRank = $loginSystem->getLoginUserRank();
    // 未登入使用者，Show404
    if (is_null($loginUserRank)) {
    	$authSystem->show404();
		exit();
    }
    // 管理者可參訪的頁面
    $adminUserRank = new UserRank(UserRank::ADMIN);
	$authSystem->redirectHomeWhenBelowRank($loginUserRank, $adminUserRank);
    
    // 設定主版
    $title = '新增設備型號';
	$navContentPath = 'contents/nav_admin.php';
	$contentPath = 'contents/editmodel.php';
	$addScripts = array();
	
    // 設定頁面內文
    $modelData = array('model' => '',
					   'category_id' => '');
    $submitValue = '新增設備型號';
	$postUrl = 'newmodel.php';
	$postDeleteImageUrl = 'newmodel.php';
	$errors = array();
	$infos = array();
	$categoryModel = new CategoryModel();
	$categories = $categoryModel->get();
	$image = NULL;
	$redirectUrl = NULL;
	
	// 處理刪除現有圖片情況
	if (isset($_POST['delete_image_id'])) {
		$fileManagement = new FileManagement();
		if ($fileManagement->delete_file($_POST['delete_image_id'])) {
			$infos[] = '圖片刪除成功';
		} else {
			$infos[] = '圖片刪除失敗';
		}
	}
	// 處理新增型號資料
	elseif (isset($_POST['model']) and isset($_POST['category_id'])) {
		$validator = new ModelValidator();
		$model = trim($_POST['model']);
		$categoryId = trim($_POST['category_id']);
		$errors = array_merge($errors, $validator->validateForAdd($model, $categoryId));
		// 驗證上傳圖片
		if (isset($_FILES['image']) and $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
			if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
				$imageName = $_FILES['image']['name'];
				$imageTmpPath = $_FILES['image']['tmp_name'];
			} else {
				$imageError = new FileError($_FILES['image']['error']);
				$errors[] = $imageError->get_error_message();
			}
		}
		// 資料驗證無錯誤，嘗試新增資料
		if (!$errors) {
			$modelModel = new ModelModel();
			if ($modelId = $modelModel->addModel($categoryId, $model)) {
				$infos[] = '設備型號新增成功';
				// 新增圖片
				if (isset($imageName)) {
					$fileManagement = new FileManagement();
					$fileId = $fileManagement->save_file($imageName, $imageTmpPath);
					if ($fileId !== False) {
						$modelModel->addModelImageById($modelId, $fileId);
					} else {
						$errors[] = '圖片上傳失敗';
					}
				}
			} else {
				$errors[] = '發生不知名錯誤，請通知管理員';
			}
			
		}
		// 資料驗證錯誤 
		else {
			$modelData['model'] = $model;
			$modelData['category_id'] = $categoryId;
		}
	}
	
	// 載入主版
    require_once 'templates/layout.php';
?>