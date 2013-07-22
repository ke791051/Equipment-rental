<?php
require '../filemanagement.php';

$filemanagement = new FileManagement();
$fileArray = $filemanagement->get_file(5); // id 替換成要下載的檔案
$filename = $fileArray[0];
$filepath = $fileArray[1];

header('Content-type: application/octet-stream');
header("Content-Disposition: attachment; filename=\"$filename\"");
print file_get_contents($filepath);