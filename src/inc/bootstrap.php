<?php
define("PROJECT_ROOT_PATH", __DIR__ . "\\..\\..");
// include main configuration file 
require_once PROJECT_ROOT_PATH . "/src/inc/config.php";
// include the base controller file 
require_once PROJECT_ROOT_PATH . "/src/Controller/Api/BaseController.php";
// include the use model file 
require_once PROJECT_ROOT_PATH . "/src/Model/UserModel.php";
?>