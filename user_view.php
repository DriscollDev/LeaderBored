<?php
    session_start();
    include './includes/header.php';
    include 'models/model_users.php';
    include 'models/model_leaderboards.php';

    if(isset($_SESSION['isLoggedIn'])){
        $username = $_SESSION['username'];
        $user = getUser($username);
        $user_id = $user['id'];
        $boards = getBoards($user_id);
        
    }
    else{
        header('Location: login.php');
    }
?>
<style>
    .leaderboard {
        height: 95vh;
        overflow-x: hidden;
}
</style>

<div class="w3-row w3-margin-top">
    <div class="w3-col s3 w3-theme-d2 w3-center">
        <h2>User Info</h2>
        <p>Username: <?php echo $user['username']; ?></p>
        <p>Created On: <?php echo $user['signdate']; ?></p>
        <br>
        <br>
        <br>
        <br>    
        <a href="./leaderboard_edit.php" class="w3-btn w3-theme-l3">Create a new Leaderboard</a>
        <br>
        <br>
        <a href="./logoff.php" class="w3-btn w3-red">Log Out</a>
    </div>
    
    <div class="w3-col s5 w3-theme-l3 w3-center leaderboard">
        <h2>Leaderboards</h2>
        <?php foreach ($boards as $board):?>
        
        <div class="w3-row w3-margin top">
            <div class="w3-col s1 w3-black w3-center">
                <p><a href='leaderboard_view.php?leaderboard_id=<?php echo $board["id"]?>'>View</a></p>
                

            </div>
            <div class="w3-col s7 w3-white w3-center">
                <p><?php echo $board["lbName"]?></p>
            </div>
            <div class="w3-col s1 w3-black w3-center">
                <p>#1</p>
            </div>
            <div class="w3-col s3 w3-white w3-center">
                <p>Yamom</p>
            </div>
        </div>
        <?php endforeach; ?>
        
    </div>
    <div class="w3-col s4 w3-theme-d2 w3-center">
        <h2>Submissions</h2>

    </div>
</div> 


    <?php include './includes/footer.php'; ?>