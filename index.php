<?php

// $response = array("name" => "Tanishq", "age" => "25");
// echo json_encode($response);

// include('src/Database.php');
// include('src/controllers/MovieController.php');
// include('src/gateways/MovieGateway.php');
// include('src/Database.php');
// include('src/controllers/ReviewController.php');
// include('src/gateways/ReviewGateway.php');

// spl_autoload_register(function($class_name){
//     include './src/'.$class_name.'.php';
// });

// spl_autoload_register(function($class_name){
//     include './src/controllers/'.$class_name.'.php';
// });

// spl_autoload_register(function ($class_name) {
//     include './src/gateways/'.$class_name.'.php';
// });

spl_autoload_register(function ($class_name) {
    $path = null;
    if (str_contains($class_name, "Controller")) {
        $path = 'src/controllers/' . $class_name . '.php';
    } else if (str_contains($class_name, "Gateway")) {
        $path = 'src/gateways/' . $class_name . '.php';
    } else {
        $path = 'src/' . $class_name . '.php';
    }
    // echo $path;
    include $path;
});


set_exception_handler("ErrorHandler::handleException");

$database = new Database();

// $resp = $movieGateway->index();
// $data = $resp->fetch_assoc();
// print_r (json_encode($resp));

$urlParts = explode("/", $_SERVER['REQUEST_URI']);
$id = $urlParts[3] ?? null;

header('content_type:application/json;charset=UTF-8');

if ($urlParts[2] === "movies") {
    // echo "hello";
    $movieGateway = new MovieGateway($database);

    $moviecontroller = new MovieController($movieGateway);

    $moviecontroller->handle_request($_SERVER['REQUEST_METHOD'], $id);
    // echo "hello";
} else if ($urlParts[2] === "reviews") {
    $reviewGateway = new ReviewGateway($database);
    $reviewController = new ReviewController($reviewGateway);
    $reviewController->handle_request($_SERVER['REQUEST_METHOD'], $id);
}
// $id = $urlParts[3] ?? null;
// echo $id;


?>