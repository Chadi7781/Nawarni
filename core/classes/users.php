<?php

class User {

    protected $pdo;

    function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }
}


?>