<?php
    session_start();
    include './includes/header.php';
    include 'models/model_users.php';
    include 'models/model_leaderboards.php';
    include 'models/model_submissions.php';

    if(isset($_SESSION['isLoggedIn'])){
        $username = $_SESSION['username'];
        $user = getUser($username);
        $user_id = $user['id'];
        $logged = true;
        if($board["ownerID"] == getUser($_SESSION["username"])["id"]){
            $owner = true;
        }
        else{
            $owner = false;
        }
    }
    else{
        //header('Location: login.php');
        $logged = false;
        $owner=false;
    }
    $board = getLeaderboard($_GET['leaderboard_id']);
    $submissions = getLeaderboardEntries($_GET['leaderboard_id']);
        
?>
<style>
    .fix{
        height: 95vh;
        overflow-x: hidden;
    }
</style>
    <div class="w3-row w3-margin-top w3-center">

        <div class="w3-col s3 w3-theme-d4 fix">
            <h3>Submissions</h3>
            <?php foreach ($submissions as $submission):?>
                <div class="w3-row w3-margin top">
                    <div class="w3-col s6 w3-theme-l2 w3-center">
                        <p><?php echo $submission["username"] ?></p>
                    </div>
                    <div class="w3-col s6 w3-theme-l3 w3-center">
                        <p><?php echo $submission["score"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="w3-col s6 w3-theme-l2 fix">
            <h2><?php echo $board["lbName"] ?></h2>
            
        </div>
        <div class="w3-col s3 w3-theme-d4  fix">
            <h3>Info</h3>
            <p><?php echo $board["description"] ?></p>
            <br>
            <h3>Created By</h3>
            <p><?php echo(searchUser($board["ownerID"])["username"]) ?></p>
            <h3>On</h3>
            <p><?php echo $board["creationDate"] ?></p>
            <?php if($owner): ?>
                <div style="height:30vh"><p></p></div>
                <a href="./leaderboard_edit.php?action=edit&leaderboard_id=<?php echo $board["id"] ?>" class="w3-btn w3-theme-l3">Edit Leaderboard</a>
            <?php endif; ?>
        </div>


    </div>









<?php include './includes/footer.php'; ?>
