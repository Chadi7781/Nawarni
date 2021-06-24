<?php

class User {

    protected $pdo;

    function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }


    public function checkInput($variable) {
        $variable = htmlspecialchars($variable);
        $variable = trim($variable);
        $variable = stripslashes($variable);

        return $variable();
    }
}


?>