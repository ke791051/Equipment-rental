<?php
require_once 'config.php';

// 取得使用者登入資料
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();

// 設定主版資料
$title = '設備出借管理系統';
if (is_null($loginUserRank)) {
    $navContentPath = 'contents/nav_guest.php';
} else {
    $navContentPath = $loginUserRank->isEqual(new UserRank(UserRank::ADMIN)) ? 'contents/nav_admin.php' : 'contents/nav_user.php';
}
$contentPath = 'contents/index.php';
$addScripts = array();

require_once 'templates/layout.php';
// End of file