<?php

include (__DIR__ . '/db.php');


function getSubmission($submission_id) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbsubmissions WHERE id= :submission_id');

    $stmt->bindValue(':submission_id', $submission_id);

    $stmt->execute();

    return $stmt->fetch();
}



function createSubmission($leaderboard_id, $user_id, $score, $validationProof) {
    global $db;

    $stmt = $db->prepare('INSERT INTO lbsubmissions (boardID, userID, score, validationProof, submissionDate) VALUES (:leaderboard_id, :user_id, :score, :validationProof, :submissionDate)');

    $stmt->bindValue(':leaderboard_id', $leaderboard_id);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':score', $score);
    $stmt->bindValue(':validationProof', $validationProof);
    $stmt->bindValue(':submissionDate', date('Y-m-d H:i:s'));

    $stmt->execute();

    return $db->lastInsertId();
}

function updateSubmission($submission_id, $data) {
    global $db;

    $stmt = $db->prepare('UPDATE lbsubmissions SET data= :data WHERE id= :submission_id');

    $stmt->bindValue(':data', $data);
    $stmt->bindValue(':submission_id', $submission_id);

    return $stmt->execute();
}

function deleteSubmission($submission_id) {
    global $db;

    $stmt = $db->prepare('DELETE FROM lbsubmissions WHERE id= :submission_id');

    $stmt->bindValue(':submission_id', $submission_id);

    return $stmt->execute();
}


function validateSubmission($submission_id) {
    global $db;

    $stmt = $db->prepare('UPDATE lbsubmissions SET isVerified=1 WHERE id= :submission_id');

    $stmt->bindValue(':submission_id', $submission_id);

    return $stmt->execute();
}


function getLeaderboardLeaders($leaderboard_id, $verificationReq) {
    global $db;

    if($verificationReq){
        $stmt = $db->prepare("SELECT * FROM lbsubmissions WHERE boardID=:leaderboard_id AND isVerified=1");
    }
    else{
        $stmt = $db->prepare("SELECT * FROM lbsubmissions WHERE boardID=:leaderboard_id");
    }

    $stmt->bindValue(':leaderboard_id', $leaderboard_id);
 
    $stmt->execute();
    
    return $stmt->fetchAll();
}