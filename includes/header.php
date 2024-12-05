<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    <!--<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">-->
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>LeaderBored</title>
    
</head>
<body>
    <div class="w3-top">
            <div class="w3-bar w3-black w3-left-align">
                <!--<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>-->
                <a href="./index.php" class="w3-bar-item w3-button w3-theme-l3"><i class="fa fa-home w3-margin-right"></i>Home</a>
                <a href="./browse_boards.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Leaderboards</a>
                <?php if(isset($_SESSION['isLoggedIn'])): ?>
                    <a href="./user_view.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white" title="Search"><i class="fa fa-user"></i></a>
                <?php else: ?>
                    <a href="./login.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-white" title="Search">Login/Signup</a>
                <?php endif ?>
            </div>
        </div>
    <div class="w3-container w3-theme-d2 " style="height:100vh; padding:0px">
        <br>



