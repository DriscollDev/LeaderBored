<?php
session_start();
include ("./includes/header.php");
?>
<div class="w3-container w3-margin-top w3-center">
    <h1>Welcome to the LeaderBored</h1> 
    <h3>Where you can compete and create competition for any hobby you may have.</h3>
    <div class="w3-row-padding w3-margin-top">
        <a href="./browse_boards.php" class="w3-btn w3-theme-l3">Browse Leaderboards</a>
    </div>
    <div class="w3-row-padding w3-margin-top">
        <a href="./login.php" class="w3-btn w3-theme-l3">Login Or Register</a>
    </div>
</div>

<?php include './includes/footer.php'; ?>



