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
        $error = "";
        $board_id = $_GET['leaderboard_id'];
        $board = getLeaderboard($board_id);
        $score = "";
        $isVerified = false;
    }
    else{
        header('Location: login.php');
    }

    
    if(isset($_GET['action']) && $_GET['action'] == 'edit'){
        $submission = getSubmission($_GET['submission_id']);
        $score = $submission['score'];
        $isVerified = $submission['isVerified'];
    }
    else{
        $score = "";
    }

    if(isset($_POST['create'])){
        $score = filter_input(INPUT_POST,'score', FILTER_SANITIZE_STRING);
        $validationProof = filter_input(INPUT_POST,'validationProof', FILTER_SANITIZE_STRING);
        
        $submission_id = createSubmission($board_id, $user_id, $score, $validationProof);
        
        header('Location: leaderboard_view.php?leaderboard_id='.$board_id);
    }
?>



<div class="w3-container w3-theme-d2 w3-margin-top">
    <div class="w3-row w3-center w3-margin-top">
        <h2>Create a new Submission</h2>
        <div class="w3-col s3"><p></p></div>
        <div class="w3-col s6 w3-white" style="min-height:50vh">
            <form method="post">
                <div class="w3-row-padding w3-margin-top">
                    <div class="w3-half">
                        <label for="sortFieldValue"><?php echo ($board["sortFieldName"] . ":" . $board["sortFieldType"])?> </label>
                        <input class="w3-input w3-border" type="text" placeholder="" name="score">
                    </div>
                    <div class="w3-half">
                        <label for="sortFieldValue">Proof (Link to screenshot or video upload) </label>
                        <input class="w3-input w3-border" type="text" placeholder="" name="validationProof">
                    </div>
                </div> 
                <div class="w3-row-padding w3-margin-top">
                    
                </div> 
                <div class="w3-col s3"><p></p></div>
                <div class="w3-row-padding w3-margin">
                    <?php if(isset($_GET['action']) && $_GET['action'] == 'edit'):?>
                    <div class="w3-third">
                        <input type="submit" name="update" value="Update Submission" class="w3-btn w3-theme-d2">
                    </div>
                    <div class="w3-third">
                        <input type="submit" name="delete" value="Delete Submission" class="w3-btn w3-red">
                    </div>
                    <div class="w3-third">
                        <p>Submitting as <?php echo $username?> Submission Date: <?php echo date('Y-m-d H:i:s') ?></p>
                    </div>
                    <?php else: ?>
                    <div class="w3-third">
                        <input type="submit" name="create" value="Create Submission" class="w3-btn w3-theme-d2">
                    </div>
                    <div class="w3-rest">
                        Submitting as <?php echo $username?> Submission Date: <?php echo date('Y-m-d H:i:s') ?>
                    </div>
                    <?php endif; ?>
                    
                </div>
            </form>
        </div>
        

    </div>
</div>






<?php include './includes/footer.php'; ?>