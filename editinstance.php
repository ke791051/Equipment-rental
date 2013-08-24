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

// 設定主版內容
$title = '編輯設備';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/editinstance.php';
$addScripts = array();

// 設定頁面內容
if (!filter_has_var(INPUT_POST, 'id')) {
	$authSystem->redirectHome();
} else {
	$instanceId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
}

$instanceModel = new InstanceModel();
$modelData = $instanceModel->getById($instanceId);

$submitValue = '編輯設備';
$postUrl = 'editinstance.php';

$modelModel = new ModelModel();
$models = $modelModel->get();

$statues = array();
foreach (InstanceStatus::getStatusCodeMessageMapping() as $code => $message) {
	$statues[] = array('code' => $code, 'message' => $message);
}

$errors = array();
$infos = array();
$redirectUrl = filter_input(INPUT_POST, 'redirecturl', FILTER_VALIDATE_URL);
if (is_null($redirectUrl)) {
	$redirectUrl = filter_input(INPUT_POST, 'postfromurl', FILTER_VALIDATE_URL);
}

// 處理更新資料
$stringSanitizeOption = array('filter' => FILTER_SANITIZE_STRING,
							  'flags' => FILTER_FLAG_STRIP_LOW);
$postData = filter_input_array(INPUT_POST, array('id' => $stringSanitizeOption,
												 'identify' => $stringSanitizeOption,
												 'location' => $stringSanitizeOption,
												 'status' => FILTER_VALIDATE_INT,
												 'note' => $stringSanitizeOption,
												 'cost' => FILTER_SANITIZE_NUMBER_INT,
												 'value' => FILTER_SANITIZE_NUMBER_INT,
												 'keeper' => $stringSanitizeOption,
												 'user' => $stringSanitizeOption,
												 'recorddate' => $stringSanitizeOption,
												 'duedate' => $stringSanitizeOption,
												 'model_id' => FILTER_VALIDATE_INT));
if (is_array($postData) and !in_array(NULL, $postData, True) and !in_array(False, $postData, True)) {
	// 驗證資料
	$validator = new InstanceValidator();
	$modelData = $postData;
	if ($postData['duedate']) {
		try {
			$postData['duedate'] = new DateTime($postData['duedate']);
		} catch (Exception $e) {
			$errors[] = '輸入的預計報廢日期有誤';
		}
	} else {
		$postData['duedate'] = NULL;
	}
	if ($postData['recorddate']) {
		try {
			$postData['recorddate'] = new DateTime($postData['recorddate']);
		} catch (Exception $e) {
			$errors[] = '輸入的取得日期有誤';
		}
	} else {
		$postData['recorddate'] = NULL;
	}
	// TODO update validator for changed model
	$errors = array_merge($errors, $validator->validateForUpdateById($postData['id'],
																	 $postData['identify'],
	 														 		 $postData['location'],
	 																 $postData['status'],
	 														  		 $postData['note'],
	 														  		 $postData['duedate'],
	 														  		 $postData['model_id']));
	// 新增資料至資料庫
	if (!$errors) {
		$instanceModel = new InstanceModel();
		$cost = $postData['cost'] ? (int) $postData['cost'] : NULL;
		$value = $postData['value'] ? (int) $postData['value'] : NULL;
		if ($instanceModel->updateInstanceById($postData['id'],
											   $postData['identify'],
								 	      	   $postData['location'],
								        	   $postData['status'],
							   	     		   $postData['note'],
								    		   $postData['duedate'],
								    		   $cost,
								    		   $value,
								    		   $postData['recorddate'],
								    		   $postData['keeper'],
								    		   $postData['user'],
								    		   $postData['model_id']) === False) 
		{
			// Should Log
			//$errors[] = '發生不知名錯誤，請通知管理員';				    	
		} else {
			$infos[] = '設備更新成功';
		}
	}
}

require_once 'templates/layout.php';
?>