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

        return $variable;
    }

    //Check email 
    public function checkEmail($email_mobile){

        $stmt = $this->pdo->prepare("SELECT  email FROM users WHERE email =:email_mobile");
        $stmt->bindValue(":email_mobile",$email_mobile,PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count > 0) {
            return true;
        }
        else 
        return false;

    }
    
    //Create user
    public function create($table, $fields = array()) {
        $column = implode(',', array_keys($fields)); //implode() combines all the array keys but looses all the values info: first-name , last-name, email-mobile
        $values = ':'.implode(', :',array_keys($fields)); // :first-name, :last-name, :mobile
        $sql = "INSERT INTO {$table}({$column}) VALUES  ($values)";
         
        //var_dump("sql =>".$sql);
        if($stmt = $this->pdo->prepare($sql)) {
            foreach($fields as $key => $data) {
                $stmt->bindValue(':'.$key, $data);
            }

            $stmt->execute();
            var_dump($stmt);
            return $this->pdo->lastInsertId();
        }




            
    }
    
}


?>