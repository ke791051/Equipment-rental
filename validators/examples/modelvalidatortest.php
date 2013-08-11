<?php
require_once 'modelvalidator.php';
$modelvalidator = new 	ModelValidator();
//$modelvalidator->validateForAdd(1,1);
$a = $modelvalidator->validateForUpdateById(6,'IBM-T60',1);
print $a[0]; 
//$modelvalidator->validateForDeleteById(1);
?>