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
        $query = "select * from movies where id=$id";
        // $result=
        $result = $this->connection->query($query);
        $data = $result->fetch_assoc();
        
        // print_r($data);
        return $data;
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
        $query = "insert into movies(name,releaseDate,rating,description,genre,cast,runtime) 
        values ('$name','$releaseDate',$rating,'$desc','$genre','$cast',$runtime)";

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
        $query="update movies set name='$name',releaseDate='$releaseDate',rating=$rating,description='$desc',genre='$genre',cast='$cast',runtime='$runtime' where id=$id";
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
