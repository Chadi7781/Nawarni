
<?php
    include "connect/config.php";

    $conn = $pdo->open();


    if(isset($_POST['first-name']) && !empty($_POST['first-name']) &&
    isset($_POST['last-name']) && !empty($_POST['last-name']) &&
    isset($_POST['email-mobile']) && !empty($_POST['email-mobile']) &&
    isset($_POST['up-password']) && !empty($_POST['up-password']) &&
    isset($_POST['birth-day']) && !empty($_POST['birth-day']) &&
    isset($_POST['birth-month']) && !empty($_POST['birth-month']) &&
    isset($_POST['birth-year']) && !empty($_POST['birth-year']) &&
    isset($_POST['gen']) && !empty($_POST['gen'])) {

        $upFirst = $_POST['first-name'];
        $upLast = $_POST['last-name'];
        $upEmailMobile = $_POST['email-mobile'];
        $upPassword = $_POST['up-password'];
        $birthDay = $_POST['birth-day'];
        $birthMonth = $_POST['birth-month'];
        $birthYear = $_POST['birth-year'];
        $upGen = $_POST['gen'];
        $birth = ''.$birthYear.'-'.$birthMonth.'-'.$birthDay.'';

        echo $birth;
    } 

    else if (empty($_POST['first-name']) or empty($_POST['last-name']) or
    empty($_POST['email-mobile']) or empty($_POST['up-password'])
    or empty($_POST['bith-day']) or empty($_POST['bith-month']) 
    or empty($_POST['bith-year']) or empty($_POST['gen'])) {
        $error = "All Field are Required";
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
    <div class="header"></div>
        <div class="main">
            <div class="left-side">
                <img src="assets/images/share_sign.png" alt="share_sign">
            </div>
            <div class="right-side">
                <div class="error">
                <?php if(!empty($error))  echo $error;?>
                </div>
                    <h1 style="color:#212121;">Create an account</h1>
                    <div style="color:#212121;font-size:20px;" >it's free and always will be</div>
                    <!--Form start -->
                    <form action="sign.php" method="POST" name="user-sign-up">
                        <div class="sign-up-form">
                            <div class="sign-up-name">
                                <input type="text" name="first-name" id="first-name" class="text-field" placeholder="First Name">
                                <input type="text" name="last-name" id="last-name" class="text-field" placeholder="Last Name">
                            </div>
                            <div class="sign-wrap-mobile">
                                <input type="text" name="email-mobile" id="email-mobile" class="text-input" placeholder="Mobile number or email address" class="text-input">
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
                                By clicking Sign Up, you agree to our terms, Data policy and Cookie policy. You may receive SMS notifications from us and can opt out at any time.

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