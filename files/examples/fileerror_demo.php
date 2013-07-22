<?php
require '../fileerror.php';

$error1 = new FileError(0);
print $error1->get_error_message();