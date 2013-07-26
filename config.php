<?php
$config = array();

$config['BASE_PATH'] = 'http://localhost:1628/htdocs/';
$config['APP_PATH'] = realpath('.') . '/';
$config['CSS_HREF'] = $config['BASE_PATH'] . 'css/style.css';
$config['SITE_TITLE'] = '資訊管理系設備出借系統';

set_include_path(get_include_path() . PATH_SEPARATOR . $config['APP_PATH']);
// End of file