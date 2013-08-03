<?php
require_once 'config.php';
// 驗證使用者是否為管理員

// 設定主版資料
$title = '管理設備型號';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/models.php';
$addScripts = array();

// 設定頁面內容
$caption = $title;
$modelModel = new ModelModel();
$navigateUrl = $config['BASE_PATH'] . 'managemodels.php';
$postDeleteUrl = $config['BASE_PATH'] . 'deletemodel.php';
$postEditUrl = $config['BASE_PATH'] . 'editmodel.php';
$operators = array('edit' => True, 'delete' => True);

// 處理分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT, 'page' => FILTER_VALIDATE_INT));
$perpage = (int) $getData['perpage'];
$page = (int) $getData['page'];
$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($modelModel->getCount() / $perpage);
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];
$models = $modelModel->get($perpage, ($page - 1) * $perpage);

require_once 'templates/layout.php';
// End of file