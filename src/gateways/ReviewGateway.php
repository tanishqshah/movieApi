<?php

class ReviewGateway
{
    private $connection = null;
    public function __construct($database)
    {
        $this->connection = $database->getConnection();
    }

    public function index()
    {
        $query = "select * from reviews";
        // $result=
        $result = $this->connection->query($query);
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // print_r($data);
        return $data;
    }

    public function show($id)
    {
        $query = "select * from reviews where id=$id";
        // $result=
        $result = $this->connection->query($query);
        $data = $result->fetch_assoc();

        // print_r($data);
        return $data;
    }

    public function create($review)
    {
        $mid = $review['mid'];
        $reviewMessage = $review['review'];
        $email = $review['email'];
        $rating = $review['rating'];

        $query = "insert into reviews(mid,review,email,rating) 
        values ($mid,'$reviewMessage','$email',$rating)";
        // echo $query;
        if ($this->connection->query($query)) {
            return true;
        }
        return false;
    }

    public function update($review, $id)
    {
        $mid = $review['mid'];
        $reviewMessage = $review['review'];
        $email = $review['email'];
        $rating = $review['rating'];

        $query = "update reviews set review='$reviewMessage',rating=$rating where id=$id";
        if ($this->connection->query($query)) {
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        $query = "delete from reviews where id=$id";
        // $result=
        if ($this->connection->query($query)) {
            return true;
        }
        return false;
    }

}

?>