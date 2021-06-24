<?php

class Post extends User {

    function __construct($pdo) 
    {
        $this->pdo = $pdo;
        
    }
}


?>