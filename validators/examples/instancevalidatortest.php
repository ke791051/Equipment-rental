<?php
require_once 'instancevalidator.php';
$ins =new InstanceValidator();
$ins->validateForAdd('1','','','','','');
$ins->validateForDeleteById('1');
$ins->validateForDeleteByIdentify('1');
$ins->validateForUpdateById('1','','','','','','');
$ins->validateForUpdateByIdentify('1','','','','','','');
?>