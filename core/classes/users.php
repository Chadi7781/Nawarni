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

    //Check email 
    public function checkEmail($email_mobile){

        $stmt = $this->pdo->prepare("SELECT  email FROM users WHERE email =:email_mobile");
        $stmt->bind(":email_mobile",$email_mobile,PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count > 0) {
            return true;
        }
        else 
        return false;
        
    }
}


?>