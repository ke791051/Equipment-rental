<?php
require_once 'config.php';

$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();

$loginSystem->logout();
$authSystem->redirectHome();
