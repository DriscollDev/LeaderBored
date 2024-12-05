<?php
session_start();
include ("./includes/header.php");
?>
<div class="w3-container w3-margin-top">
    <a href="./logoff.php" class="w3-btn w3-black">LogOut</a>
    <?php print_r($_SESSION)?>
    </div>
</body>

<?php include './includes/footer.php'; ?>



