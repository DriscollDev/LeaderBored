<?php
    session_start();
    include './includes/header.php';
    include 'models/model_users.php';
    include 'models/model_leaderboards.php';
    include 'models/model_submissions.php';
    include 'models/functions.php';

    if(isset($_SESSION['isLoggedIn'])){
        $username = $_SESSION['username'];
        $user = getUser($username);
        $user_id = $user['id'];
        $logged = true;
        
    }
    else{
        //header('Location: login.php');
        $logged = false;
        $owner=false;
    }
    $board = getLeaderboard($_GET['leaderboard_id']);
    $submissions = getLeaderboardEntries($_GET['leaderboard_id']);
    if($board["ownerID"] == getUser($_SESSION["username"])["id"]){
        $owner = true;
    }
    else{
        $owner = false;
    }


    
    
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
                <div class="w3-row w3-margin top w3-center w3-theme-l3">
                    <div class="w3-col <?= ($owner and !$submission['isVerified']) ? 's4' : 's6' ?> ">
                        <p><?php echo searchUser($submission["userID"])["username"] ?></p>
                    </div>
                    <div class="w3-col <?= ($owner and !$submission['isVerified']) ? 's4' : 's6'?>">
                        <p><?php echo $submission["score"] ?></p>
                    </div>
                    <?php if($owner and !$submission['isVerified']): ?>
                        <div class="w3-col s4">
                            <p><a href="verify_submission.php?submission_id=<?php echo $submission['id'] ?>" class="w3-btn w3-theme-d2">Verify</a></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <a href="submission_edit.php?leaderboard_id=<?php echo $board["id"] ?>" class="w3-btn w3-theme-l3">Make a Submission</a>
        </div>
        <div class="w3-col s6 w3-theme-l2 fix">
            <h2><?php echo $board["lbName"] ?></h2>
            <?php 
                $boardLeaders = getLeaderboardLeaders($board["id"],$board["isValidationReq"]);
                if($board["sortFieldType"] == "Int"){
                    usort($boardLeaders, 'intComp');
                }
                else{
                    usort($boardLeaders, 'timeComp');
                }
                if($board["sortFieldDirection"] == "Desc"){
                    $boardLeaders = array_reverse($boardLeaders);
                }
            ?>
            <?php foreach ($boardLeaders as $entry):?>
                <div class="w3-row w3-margin top w3-center w3-theme-l3">
                    <div class="w3-col s4">
                        <p><?php echo searchUser($entry["userID"])["username"] ?></p>
                    </div>
                    <div class="w3-col s4">
                        <p><?php echo $entry["score"] ?></p>
                    </div>
                    <div class="w3-col s4">
                        <p><?php echo $entry["submissionDate"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
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
