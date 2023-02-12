<?php

// $response = array("name" => "Tanishq", "age" => "25");
// echo json_encode($response);

include('src/Database.php');
include('src/controllers/MovieController.php');
include('src/gateways/MovieGateway.php');

$database = new Database();

// $resp = $movieGateway->index();
// $data = $resp->fetch_assoc();
// print_r (json_encode($resp));

$urlParts = explode("/", $_SERVER['REQUEST_URI']);
$id = $urlParts[3] ?? null;


if ($urlParts[2] === "movies") {
    // echo "hello";r
    $movieGateway = new MovieGateway($database);

    $moviecontroller = new MovieController($movieGateway);

    $moviecontroller->handle_request($_SERVER['REQUEST_METHOD'], $id);
    // echo "hello";
}
// $id = $urlParts[3] ?? null;
// echo $id;


?>