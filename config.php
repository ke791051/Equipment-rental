<?php
$config = array();

$config['BASE_PATH'] = 'http://localhost:1628/htdocs/';
// $config['APP_PATH'] = realpath('.') . '/';
$config['APP_PATH'] = 'I:\xampp\htdocs\htdocs/';
$config['CSS_HREF'] = $config['BASE_PATH'] . 'css/style.css';
$config['SITE_TITLE'] = '資訊管理系設備出借系統';
$config['DEFAULT_PERPAGE'] = 7;
$config['DEFAULT_PAGE'] = 1;
$config['DEFAULT_ADMIN_HOME'] = 'manageregisters.php';
$config['DEFAULT_USER_HOME'] = 'register.php';

set_include_path(get_include_path() . PATH_SEPARATOR . $config['APP_PATH']);

$config['MODULES_MAPPING'] = array('AuthSystem' => 'auth/authsystem.php',
								   'LoginSystem' => 'auth/loginsystem.php',
								   'UserRank' => 'auth/userrank.php',
								   'BaseDatabase' => 'connection/connection.php',
								   'CategoryModel' => 'models/categorymodel.php',
								   'FixlogModel' => 'models/fixlogmodel.php',
								   'InstanceModel' => 'models/instancemodel.php',
								   'LendModel' => 'models/lendmodel.php',
								   'ModelModel' => 'models/modelmodel.php',
								   'RegisterModel' => 'models/registermodel.php',
								   'UserModel' => 'models/usermodel.php',
								   'CategoryValidator' => 'validators/categoryvalidator.php',
								   'InstanceValidator' => 'validators/instancevalidator.php',
								   'ModelValidator' => 'validators/modelvalidator.php',
								   'FileChecker' => 'files/filechecker.php',
								   'FileEror' => 'files/fileerror.php',
								   'FileManagement' => 'files/filemanagement.php',
								   'InstanceStatus' => 'models/instancestatus.php');
function __autoload($className) {
	global $config;
	if (array_key_exists($className, $config['MODULES_MAPPING'])) {
		require_once $config['MODULES_MAPPING'][$className];
	}
}

// spl_autoload_register('myautoload');
// End of file