<?php
    session_start();
    /*Users currently in database
      username  : password
     1: doug    : password
     2: conor   : pass
    */
    include './includes/header.php';
    include 'models/model_users.php';

    $logerror = "";
    $signerror = "";

    if(isset($_POST['login'])){
        $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
    
        if(login($username, $password)){
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
        }
        else{
            $logerror = "You did not provide correct creds";
        }
    }
    if(isset($_POST['signup'])){
        $username = filter_input(INPUT_POST,'signusername', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST,'signpassword', FILTER_SANITIZE_STRING);
    
        if($username == "" || $password == ""){
            $signerror = "You did not provide correct creds";
        }
        else if(userExists($username)){
            $signerror = "User already exists";
        }
        else if(register($username, $password)){
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
        }
        else{
            $signerror = "You did not provide correct creds";
        }
    }
?>

<div style="height:25vh"></div>
<div class="w3-row w3-margin-top">

    <div class="w3-col s6 w3-center">
        <form method="post">
            <div class="">
                <h3>Login</h3>
            </div>
            <div class="">
                <div class="">User Name:</div>
                <div class=""><input type="text" name="username" pattern="[a-z0-9_-]{3,15}" value=""></div> 
            </div>
            <div class="">
                <div class="">Password:</div>
                <div class=""><input type="password" name="password" pattern="[a-z0-9_-]{3,15}" value=""></div> 
            </div>
                <div class="">
                <div class="">&nbsp;</div>
                <div class="">
                    <input type="submit" name="login" value="Log In" class="w3-btn w3-black">
                </div> 
            </div>
            <?php
                if ($logerror != "") {
            ?>
            <div class="w3-text-red"><?php echo $logerror; ?></div>
            <?php
                }
            ?>
        </form>
        <br>
        <br>
        <br>    
        <br>
        <br>
        <br>
    </div>
    <div class="w3-col s6 w3-center">
    <form method="post">
            <div class="">
                <h3>Sign Up</h3>
            </div>
            <div class="">
                <div class="">User Name:</div>
                <div class=""><input type="text" name="signusername" pattern="[a-z0-9_-]{3,15}" value=""></div> 
            </div>
            <div class="">
                <div class="">Password:</div>
                <div class=""><input type="password" name="signpassword" pattern="[a-z0-9_-]{3,15}" value=""></div> 
            </div>
                <div class="">
                <div class="">&nbsp;</div>
                <div class="">
                    <input type="submit" name="signup" value="Sign Up " class="w3-btn w3-black">
                </div> 
            </div>
            <?php
                if ($signerror != "") {
            ?>
            <div class="w3-text-red"><?php echo $signerror; ?></div>
            <?php
                }
            ?>
        </form>
        <br>
        <br>
        <br>    
        <br>
        <br>
        <br>
    </div>
                    
        

    </div>






<?php include './includes/footer.php';