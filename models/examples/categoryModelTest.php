<pre>
<?php
require_once '../categorymodel.php';
header('Content-Type: text/html; charset=utf-8;');
$categorymodel = new CategoryModel();

// 新增設備分類
/*
if ($categorymodel->addCategory('測試分類')) {
    print "分類新增成功\n";
} else {
    print "分類新增失敗\n";
    print $categorymodel->getStatementErrorMessage();
}
//*/

// 更新設備分類
/*
if ($categorymodel->updateCategoryById(1, '筆記型電腦')) {
    print "分類更新成功\n";
} else {
    print "分類更新失敗\n";
}
//*/

// 移除設備分類
/*
if ($categorymodel->removeCategoryById(4)) {
    print "分類移除成功\n";
} else {
    print "分類移除失敗\n";
    print $categorymodel->getStatmentErrorMessage();
}
//*/

// 新增設備分類圖片
/*
if ($categorymodel->addCategoryImageById(2, 1)) {
    print "設備分類圖片新增成功\n";
} else {
    print "設備分類圖片新增失敗\n";
    print $categorymodel->getStatementErrorMessage();
}
//*/

// 移除設備分類圖片
/*
if ($categorymodel->removeCategoryImageById(2, 1)) {
    print "設備分類圖片移除成功\n";
} else {
    print "設備分類圖片移除失敗\n";
    print $categorymodel->getStatementErrorMessage();
}
//*/

// 取得指定的設備分類
/*
print_r($categorymodel->getById(3));
//*/

// 取得指定設備分類的圖片
//print_r($categorymodel->getCategoryImagesById(2));

// 取得指定設備分類的圖片
//print_r($categorymodel->getCategoryImagesByName('測試分類'));

// 取得所有設備分類
print_r($categorymodel->get());
//print $categorymodel->getStatementErrorMessage();

?>
</pre>