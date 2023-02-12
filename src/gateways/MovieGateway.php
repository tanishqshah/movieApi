<?php

class MovieGateway{
    private $connection = null;
    public function __construct($database){
        $this->connection = $database->getConnection();
    }

    public function index(){
        $query = "select * from movies";
        // $result=
        $result=$this->connection->query($query);
        $data = array();

        while($row=$result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function create($movie){
        $name=$movie['name'];
        $releaseDate=$movie['releaseDate'];
        $rating=$movie['rating'];
        $desc=$movie['description'];
        $genre=$movie['genre'];
        $cast=$movie['cast'];
        $runtime=$movie['runtime'];
        $query="insert into movies(name,releaseDate,rating,description,genre,cast,runtime) 
        values ('$name','$releaseDate',$rating,'$desc','$genre','$cast',$runtime)";

        if($this->connection->query($query)){
            return true;
        }
        return false;
    }

}

?>