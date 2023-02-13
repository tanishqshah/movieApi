<?php

class ReviewController
{

    private $reviewgateway = null;

    public function __construct($gateway)
    {
        $this->reviewgateway = $gateway;
    }
    public function handle_request($method, $id)
    {
        if ($id !== null && strlen($id) > 0) {
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
            $response = $this->reviewgateway->index();
            echo json_encode($response);
        } else {
            // echo "hello";
            $review = file_get_contents('php://input');
            $review = json_decode($review, true);
            $review = (array) $review;
            $response = $this->reviewgateway->create($review);
            if ($response) {
                echo json_encode(array("success" => true, "message" => "review created"));
            } else
                echo json_encode(array("success" => false, "message" => "review not created"));

        }

    }
    public function processResourceRequest($method, $id)
    {
        switch ($method) {
            case 'GET': {
                    $response = $this->reviewgateway->show($id);
                    echo json_encode($response);
                    break;
                }
            case 'PUT': {
                    $review = file_get_contents('php://input');
                    $review = json_decode($review, true);
                    $review = (array) $review;
                    $response = $this->reviewgateway->update($review, $id);
                    if ($response) {
                        echo json_encode(array("success" => true, "message" => "review updated"));
                    } else
                        echo json_encode(array("success" => false, "message" => "review not updated"));

                    // echo json_encode($response);
                    // break;
                    break;
                }
            case 'DELETE': {
                    $response = $this->reviewgateway->delete($id);
                    if ($response) {
                        echo json_encode(array("success" => true, "message" => "review deleted"));
                    } else
                        echo json_encode(array("success" => false, "message" => "review not deleted"));

                    break;
                }
        }
    }
}

?>