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
        $submission_id = $_GET['submission_id'];
        $submission = getSubmission($submission_id);
        $submitter = searchUser($submission['userID']);
        $submissionDate = $submission['submissionDate'];
        $score = $submission['score'];
        $proof_link = $submission['validationProof'];
    }
    else{
        header('Location: login.php');
    }

    if(isset($_POST['validate'])){
        validateSubmission($submission_id);
        header('Location: leaderboard_view.php?leaderboard_id='.$submission['boardID']);
    }


?>



<div class="w3-container w3-theme-d2 w3-margin-top">
    <div class="w3-row w3-center w3-margin-top">
        <h2>Verify Submission</h2>
        <div class="w3-col s3"><p></p></div>
        <div class="w3-col s6 w3-white" style="min-height:50vh">
            <form method="post">
                <div class="w3-containter">
                    <p><strong>Submitter:</strong> <?php echo htmlspecialchars($submitter['username']); ?></p>
                    <p><strong>Score:</strong> <?php echo htmlspecialchars($score); ?></p>
                    <p><strong>Proof Link:</strong> <a href="<?php echo $proof_link?>"><?php echo $proof_link?></a></p>
                </div>           
                <div class="w3-container w3-margin-top"></div>
                    <form action="post">
                        <button type="submit" name="validate" class="w3-button  w3-theme-d2">Validate Submission</button>
                    </form>
                    
                </div>

            </form>
        </div>
        

    </div>
</div>