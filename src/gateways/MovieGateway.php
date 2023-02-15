<?php

class MovieGateway
{
    private $connection = null;
    public function __construct($database)
    {
        $this->connection = $database->getConnection();
    }

    public function index()
    {
        $query = "select * from movies";
        // $result=
        $result = $this->connection->query($query);
        $data = array();


        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // print_r($data);
        return $data;
    }

    public function show($id){
        $moviequery = "select * from movies where id=$id";
        // $result=
        $movieresult = $this->connection->query($moviequery);
        $movie = $movieresult->fetch_assoc();
        
        $reviews = [];

        $rquery = "select * from reviews where mid=$id";
        $res = $this->connection->query($rquery);
        while($row=$res->fetch_assoc()){
            $reviews[]=$row;
        }

        $data = array("movie"=>$movie,"reviews"=>$reviews);
        return $data;

        // print_r($data);
        // return $data;
    }
    
    public function create($movie)
    {
        $name = $movie['name'];
        $releaseDate = $movie['releaseDate'];
        $rating = $movie['rating'];
        $desc = $movie['description'];
        $genre = $movie['genre'];
        $cast = $movie['cast'];
        $runtime = $movie['runtime'];
        $poster=$movie['poster'];
        $query = "insert into movies(name,releaseDate,rating,description,genre,cast,runtime,poster) 
        values ('$name','$releaseDate',$rating,'$desc','$genre','$cast',$runtime,$poster)";

        if ($this->connection->query($query)) {
            return true;
        }
        return false;
    }

    public function update($movie,$id)
    {
        $name = $movie['name'];
        $releaseDate = $movie['releaseDate'];
        $rating = $movie['rating'];
        $desc = $movie['description'];
        $genre = $movie['genre'];
        $cast = $movie['cast'];
        $runtime = $movie['runtime'];
        $poster=$movie['poster'];
        $query="update movies set name='$name',releaseDate='$releaseDate',rating=$rating,description='$desc',genre='$genre',cast='$cast',runtime='$runtime',poster='$poster' where id=$id";
        if ($this->connection->query($query)) {
            return true;
        }
        return false;
    }
    public function delete($id){
        $query = "delete from movies where id=$id";
        // $result=
        if ($this->connection->query($query)) {
            return true;
        }
        return false;
    }

}

?>
