<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

require __DIR__ . "/src/inc/bootstrap.php";

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // It's a preflight request. Respond successfully:
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    header('HTTP/1.1 200 OK');
    exit();
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ((isset($uri[3]) && $uri[3] != 'document') || !isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

require PROJECT_ROOT_PATH . "/src/Controller/Api/UserController.php";
$objFeedController = new UserController();

$strMethodName = $uri[4] . 'Action';
$objFeedController->{$strMethodName}();
?>
