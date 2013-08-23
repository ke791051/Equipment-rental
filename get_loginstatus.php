<?php
require_once 'config.php';
/**
 * 取得登入的資訊
 * 
 * 回傳json：
 * 	{"isLogin" : boolean,
 * 	 "userName" : string|null,
 *   "rankName" : string|null}
 * 
 */

header('Content-Type: application/json; charset=utf-8');
 
$loginSystem = new LoginSystem();

$result = array("isLogin" => NULL,
				"userName" => NULL,
				"rankName" => NULL);
				
if ($loginSystem->getLoginUserId()) {
	$result['isLogin'] = True;
	$result['userName'] = $loginSystem->getLoginUserData()['name'];
	$userRank = $loginSystem->getLoginUserRank();
	$result['rankName'] = $userRank->__toString();
} else {
	$result['isLogin'] = False;
}

echo json_encode($result);
