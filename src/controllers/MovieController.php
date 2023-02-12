<?php

class MovieController
{

    private $moviegateway = null;

    public function __construct($gateway)
    {
        $this->moviegateway = $gateway;
    }
    public function handle_request($method, $id)
    {
        if (strlen($id) > 0 && $id !== null) {
            // echo "getting id";
            // echo "<br>" . strlen($id) . "<br>";
            // echo "getting id";
            $this->processResourceRequest($method, $id);
        } else {
            $this->processRequest($method);
        }
    }

    public function processRequest($method)
    {
        if ($method === 'GET') {
            // echo "getting get"; 
            $response = $this->moviegateway->index();
            echo json_encode($response);
        } else {
            $movie = file_get_contents('php://input');
            $movie = json_decode($movie, true);
            $movie = (array) $movie;
            $response = $this->moviegateway->create($movie);
            if($response){
                echo json_encode(array("success" => true, "message" => "movie created"));
            }
            else    
                echo json_encode(array("success" => false, "message" => "movie not created"));

        }

    }
    public function processResourceRequest($method, $id)
    {

    }
}

?>