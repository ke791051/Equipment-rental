<?php
	require_once 'config.php';
    // 驗證使用者權限
    $authSystem = new AuthSystem();
	$loginSystem = new LoginSystem();
	
	$loginUserRank = $loginSystem->getLoginUserRank();
    // 未登入使用者
    if (is_null($loginUserRank)) {
    	$authSystem->redirectHome();
    }
    // 管理者可參訪的頁面
    $adminUserRank = new UserRank(UserRank::ADMIN);
	$authSystem->redirectHomeWhenBelowRank($loginUserRank, $adminUserRank);
    
    // 設定主版
    $title = '新增設備';
	$navContentPath = 'contents/nav_admin.php';
	$contentPath = 'contents/editinstance.php';
	$addScripts = array();
	
    // 設定頁面內文
    $modelData = array('id'=> NULL,
					   'identify' => NULL,
					   'location' => NULL,
					   'status' => NULL,
					   'note' => NULL,
					   'duedate' => NULL,
					   'cost' => NULL,
					   'value' => NULL,
					   'recorddate' => NULL,
					   'keeper' => NULL,
					   'user' => NULL,
					   'model_id' => NULL);
					   
	$identify = '';
	$location = '';
	$status = '';
	$note = '';
	$duedate = '';
	$model_id = '';
    $submitValue = '新增設備';
	$postUrl = $config['BASE_PATH'] . 'newinstance.php';
	$postDeleteImageUrl = $config['BASE_PATH'] . 'newinstance.php';
	$errors = array();
	$infos = array();
	$instancestatus = InstanceStatus::getStatusCodeMessageMapping();
	foreach ($instancestatus as $a=>$b)
	{
		$inArray = array();
		$inArray['code'] = $a;
		$inArray['message'] = $b;
		$statues[] = $inArray;
	}
	$modelModel = new ModelModel();
	$models = $modelModel -> get();
	$image = NULL;
	$redirectUrl = NULL;
	// 處理新增型號資料
	if (isset($_POST['identify'])) {
		$identify = $_POST['identify'];
		$location = $_POST['location'];
		$status = $_POST['status'];
		$note = $_POST['note'];
		$cost = filter_input(INPUT_POST, FILTER_VALIDATE_INT);
		$cost = $cost ? $cost : NULL;
		$value = filter_input(INPUT_POST, FILTER_VALIDATE_INT);
		$value = $value ? $value : NULL;
		$keeper = $_POST['keeper'] ? $_POST['keeper'] : NULL;
		$user = $_POST['user'] ? $_POST['user'] : NULL;
		if($_POST['duedate'])
		{
			$duedate = new DateTime($_POST['duedate']);
		}
		else
		{
			$duedate = NULL;
		}
		$recorddate = NULL;
		if ($_POST['recorddate']) {
			try {
				$recorddate = new DateTime($_POST['recorddate']);
			} catch (Exception $e) {
				$errors[] = '取得日期格式錯誤';
			}
		}
		$model_id = $_POST['model_id'];
		$validator = new InstanceValidator();
		// TODO update validator for changed model
		$errors = $validator->validateForAdd($identify, $location, $status, $note, $duedate, $model_id); 
		$identify = trim($_POST['identify']);
		// 資料驗證無錯誤，嘗試新增資料
		if (!$errors) {
			$instanceModel = new InstanceModel();
			if ($instanceModel->addInstance($identify, $location, $status, $note, $duedate, $cost, $value, $recorddate, $keeper, $user, $model_id)) {
				$infos[] = '設備新增成功';
			} else {
				$errors[] = '發生不知名錯誤，請通知管理員';
				// $errors[] = $instanceModel->getStatementErrorMessage();
			}
			
		}
		// 資料驗證錯誤 
		else {
			$modelData['identify'] = $identify;
			$modelData['location'] = $location;
			$modelData['status'] = $status;
			$modelData['note'] = $note;
			$modelData['cost'] = $cost;
			$modelData['value'] = $value;
			$modelData['recorddate'] = $recorddate;
			$modelData['keeper'] = $keeper;
			$modelData['user'] = $user;
			if($duedate!='')
			{
				$modelData['duedate'] = $duedate->format('Y-m-d');
			}
			$modelData['model_id'] = $model_id;
			
		}
	}
	
	// 載入主版
    require_once 'templates/layout.php';
?>