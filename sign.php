<?php
    require 'connect/DB.php';
    require 'core/load.php';


    if(isset($_POST['first-name']) && !empty($_POST['first-name'])) {
        
        $upFirst = $_POST['first-name'];
        $upLast = $_POST['last-name'];
        $upEmailMobile = $_POST['email-mobile'];
        $upPassword = $_POST['up-password'];
        $birthDay = $_POST['birth-day'];
        $birthMonth = $_POST['birth-month'];
        $birthYear = $_POST['birth-year'];

        //Hashage password
        $passwordHash = password_hash($upPassword, PASSWORD_BCRYPT);

        if(!empty($_POST['gen'])) {
            $upGen = $_POST['gen'];
        
        }
        $birth = ''.$birthYear.'-'.$birthMonth.'-'.$birthDay.'';
        if(empty($upFirst) or empty($upLast) or empty($upEmailMobile) or empty($upGen)) {
            $error = "All fields are required !";
        }
        else {
            $firstName =  $loadFromUser->checkInput($upFirst);
            $lastName =  $loadFromUser->checkInput($upLast);
            $emailMobile =  $loadFromUser->checkInput($upEmailMobile);
            $password =  $loadFromUser->checkInput($upPassword);
            $screenName =  ''.$firstName.'_'.$lastName;


            if(DB::query("SELECT screenName FROM users WHERE screenName =:screenName", 
            array(':screenName'=> $screenName))) {
                $screenRand = rand();
                $userLink = ''.$screenName.''.$screenRand.'';

            }
            else {
                $userLink = $screenName;    
            }
            if(!preg_match("^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$^",$emailMobile)) {
                if(!preg_match("^[0-9]{8}^", $emailMobile)){
                    $error = "Email id or Mobile number is not correct. Please tyr again";
                }
                else {
                    $mobile = strlen((string)$emailMobile);
                    
                    if($mobile != 8 ) {
                        $error = "Mobile number is not valid.";
                    }
                    else if(strlen($password) < 5  || strlen($password) >=60) {
                        $error = "Passowrd is not correct.";
                    }
                    else {

                        if(DB::query("SELECT mobile FROM users WHERE mobile = :mobile",array(":mobile"=>$mobile))) {
                            $error = "Mobile is already exist.";
                        }
                        else {
                            $user_id = $loadFromUser->create('users', array('first_name'=>$firstName,'last_name'=>$lastName,
                            'mobile'=>$emailMobile,'password'=>$passwordHash,
                            "screenName"=>$screenName,"userLink"=>$userLink, 'birthday'=>$birth,
                            "gender"=>$upGen));

                            $tsStrong = true;
                            $token = bin2hex(openssl_random_pseudo_bytes(64, $tsStrong));
                            $loadFromUser->create('token', array('token'=>$token,'user_id'=>$user_id));
            
                           setcookie('FBID', $token, time() + 60 *60*24*7, '/', NULL, NULL, true );
            
                           //Redirect the user to index page
                           header('Location: index.php');
            
                        }
                    } 
                }
            }

            else if(!filter_var($emailMobile)) {
                $error = "Invalid email format.";
            }
            else if(strlen($firstName)  > 20 || strlen($firstName) < 2) {
                $error ="First Name must be between 2 and 20";
            }
            else if(strlen($password) < 5 && strlen($password) >= 60) {
                $error = "The Password is either too short or too long.";
            }
            else if((filter_var($emailMobile,FILTER_VALIDATE_EMAIL)) && 
            $loadFromUser->checkEmail($emailMobile) === true) {
                $error = "Email is already exist.";
            }
            else {
                $user_id = $loadFromUser->create('users', array('first_name'=>$firstName,'last_name'=>$lastName,
                'email'=>$emailMobile,'password'=>$passwordHash,
                "screenName"=>$screenName,"userLink"=>$userLink, 'birthday'=>$birth,
                "gender"=>$upGen));
      
                $tsStrong = true;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $tsStrong));
                $loadFromUser->create('token', array('token'=>$token,'user_id'=>$user_id));

               setcookie('FBID', $token, time() + 60 *60*24*7, '/', NULL, NULL, true );
               //Redirect the user to index page
               header('Location: index.php');

            }   




        }
    } 

  
    
    else {
        echo "User not found !";

    }
                      




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nawarni</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="header">
        <div class="logo">Nawarni</div>
        <form action="sign.php" method="post">
            <div class="sign-in-form">
                <div class="mobile-input">
                    <div class="input-text">
                        Email or Phone
                    </div>
                    <input type="text" name="in-email-mobile" id="email-mobile" class="input-text-field">
                </div>
                <div class="passowrd-input">
                    <div class="input-text-password">Password</div>

                    <input type="password" name="in-pass" id="in-password" class="input-text-field">

                    <div class="forgotten-acc">Forgotten account</div>

                </div>

                <div class="login-button">
                    <input type="submit" value="Log in" class="sign-in login">
                </div>


            </div>
        </form>
    </div>
    <div class="main">
        <div class="left-side">
            <img src="assets/images/signPicture.png" alt="share_sign">
        </div>
        <div class="right-side">
            <div class="error">
                <?php if(!empty($error))  echo $error;?>
            </div>
            <h1 style="color:#212121;">Create an account</h1>
            <div style="color:#212121;font-size:20px;">it's free and always will be</div>
            <!--Form start -->
            <form action="sign.php" method="POST" name="user-sign-up">
                <div class="sign-up-form">
                    <div class="sign-up-name">
                        <input type="text" name="first-name" id="first-name" class="text-field"
                            placeholder="First Name">
                        <input type="text" name="last-name" id="last-name" class="text-field" placeholder="Last Name">
                    </div>
                    <div class="sign-wrap-mobile">
                        <input type="text" name="email-mobile" id="email-mobile" class="text-input"
                            placeholder="Mobile number or email address" class="text-input">
                    </div>
                    <div class="sign-up-password">
                        <input type="password" name="up-password" id="up-password" class="text-input">
                    </div>
                    <div class="sign-up-birthday">
                        <div class="bday">Birthday</div>
                        <div class="form-birthday">
                            <select name="birth-day" id="days" class="select-body">
                            </select>
                            <select name="birth-month" id="months" class="select-body">
                            </select>
                            <select name="birth-year" id="years" class="select-body">
                            </select>
                        </div>
                    </div>

                    <div class="gender-wrap">
                        <input type="radio" name="gen" id="fem" value="female" class="m0">
                        <label for="fem" class="gender">Female</label>
                        <input type="radio" name="gen" id="male" value="male" class="m0">
                        <label for="male" class="gender">Male</label>

                    </div>
                    <div class="term">
                        By clicking Sign Up, you agree to our terms, Data policy and Cookie policy. You may receive SMS
                        notifications from us and can opt out at any time.

                    </div>
                    <button type="submit" value="Sign Up" class="sign-up-button">Sign Up
                </div>

            </form>

            <!--Form end -->

        </div>

    </div>

    <!--Jquery library-->
    <script src="assets/js/jquery.min.js"></script>

    <!--Main Js-->
    <script src="assets/js/main.js"></script>




</body>

</html>