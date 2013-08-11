<?php
require_once 'categoryvalidator.php';
$categoryvalidator = new 	CategoryValidator();
$categoryvalidator->validateForAdd('筆記型電腦');
$a = $categoryvalidator->validateForUpdateById(2,'IBM-T60');
$categoryvalidator->validateForDeleteById(1);
?>