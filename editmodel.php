<?php
require_once 'config.php';

// 驗證使用者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}
$adminUserRank = new UserRank(UserRank::ADMIN);
$authSystem->redirectHomeWhenBelowRank($loginUserRank, $adminUserRank);

// 載入主版資料
$title = '編輯設備型號';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/editmodel.php';
$addScripts = array();

// 載入頁面資料
if (!filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
	$authSystem->redirectHome();
} else {
	$modelId = (int) $_POST['id'];
}
$modelModel = new ModelModel();
$submitValue = '更新設備型號';
$postUrl = $config['BASE_PATH'] . 'editmodel.php';
$postDeleteImageUrl = $config['BASE_PATH'] . 'editmodel.php';
$filemanagement = new FileManagement();
$errors = array();
$infos = array();
$categoryModel = new CategoryModel();
$categories = $categoryModel->get();
$redirectUrl = NULL;
if (isset($_POST['redirecturl'])) {
	$redirectUrl = filter_input(INPUT_POST, 'redirecturl', FILTER_SANITIZE_URL);
}

// 處理新增資料
$stringSanitizeOption = array('filter' => FILTER_SANITIZE_STRING,
							  'flags' => FILTER_FLAG_STRIP_LOW);
$postData = filter_input_array(INPUT_POST, array('id' => FILTER_VALIDATE_INT,
												 'model' => $stringSanitizeOption,
												 'category_id' => FILTER_VALIDATE_INT));
if (is_array($postData) and !in_array(NULL, $postData, True) and !in_array(False, $postData, True)) {
	// 驗證資料
	$validator = new ModelValidator();
	$errors = array_merge($errors, $validator->validateForUpdateById($postData['id'],
																	 $postData['model'],
																	 $postData['category_id']));
	$modelData = $postData;
	if (!$errors) {
		// 更新設備型號
		if ($modelModel->updateModelById($postData['id'], $postData['category_id'], $postData['model'])) {
			$infos[] = '設備更新成功';
		}
		// 更新設備型號圖片
		if (isset($_FILES['image']) and isset($_FILES['image']['error']) and $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
			// 上傳失敗
			if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
				$fileError = new FileError($_FILES['image']['error']);
				$errors[] = $fileError->get_error_message();
			} else {
				$newImageId = $filemanagement->save_file($_FILES['image']['name'], $_FILES['image']['tmp_name']);
				if ($newImageId === False) {
					$errors[] = '圖片上傳失敗';
				} else {
					$modelModel->addModelImageById($modelId, $newImageId);
					$infos[] = '圖片上傳成功';
				}
			}
		}
	}
} else {
	$modelData = $modelModel->getById($modelId);
}

// 處理刪除圖片操作
$postDeleteData = filter_input_array(INPUT_POST, array('delete_image_id' => FILTER_VALIDATE_INT));
if (is_array($postDeleteData) and !in_array(NULL, $postDeleteData, True)) {
	if ($modelModel->removeModelImageById($modelId, $postDeleteData['delete_image_id'])) {
		$infos[] = '圖片刪除成功';
	} else {
		$errors[] = '圖片刪除失敗';
	}
	$filemanagement->delete_file($postDeleteData['delete_image_id']);
}

// 載入型號圖片
$imageIds = $modelModel->getModelImagesById($modelId, 1);
if ($imageIds) {
	$image = $filemanagement->get_file($imageIds[0][0]);
	$image['name'] = $image[0];
	$image['path'] = $image[1];
	$image['id'] = $imageIds[0][0];
} else {
	$image = NULL;
}
require_once 'templates/layout.php';
?>