<?php
require '../filemanagement.php';

$filemanagement = new FileManagement();

print '<pre>';

// Save file
/*
if ($filemanagement->save_file('demo.php', './filemanagement_demo.php')) {
    print "儲存成功\n";
} else {
    print "儲存失敗\n";
}
//*/

// get file

$file = $filemanagement->get_file(5);
print_r($file);
//*/

// delete file
/*
if ($filemanagement->delete_file(3)) {
    print "刪除成功\n";
} else {
    print "刪除失敗\n";
}
//*/

// rename file
/*
if ($filemanagement->rename_file(3, 'filemanagement_demo.php')) {
    print "更名成功\n";
} else {
    print "更名失敗\n";
}
//*/
print '</pre>';