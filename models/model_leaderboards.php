<?php

include (__DIR__ . '/db.php');

function createLeaderboard($name, $description, $data_type, $sort_direction, $user_id, $validationreq, $fieldName) {
    global $db;

    $stmt = $db->prepare('INSERT INTO lbleaderboards (lbname, description, sortFieldType, sortFieldDirection, ownerID, isValidationReq, creationDate, sortFieldName) VALUES (:name, :description, :data_type, :sort_direction, :user_id, :validationreq, :creationDate, :fieldName)');

    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':data_type', $data_type);
    $stmt->bindValue(':sort_direction', $sort_direction);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':validationreq', $validationreq);
    $stmt->bindValue(':creationDate', date('Y-m-d H:i:s'));
    $stmt->bindValue(':fieldName', $fieldName);

    $stmt->execute();

    return $db->lastInsertId();
}

function getLeaderboard($leaderboard_id) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbleaderboards WHERE id= :leaderboard_id');

    $stmt->bindValue(':leaderboard_id', $leaderboard_id);

    $stmt->execute();

    return $stmt->fetch();
}
function getAllLeaderboards(){
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbleaderboards');

    $stmt->execute();

    return $stmt->fetchAll();
}

function updateLeaderboard($leaderboard_id, $name, $description, $data_type, $sort_direction, $validationreq, $fieldName) {
    global $db;

    $stmt = $db->prepare('UPDATE lbleaderboards SET lbname= :name, description= :description, sortFieldType= :data_type, sortFieldDirection= :sort_direction, isValidationReq= :validationreq, sortFieldName= :fieldName WHERE id= :leaderboard_id');

    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':data_type', $data_type);
    $stmt->bindValue(':sort_direction', $sort_direction);
    $stmt->bindValue(':validationreq', $validationreq);
    $stmt->bindValue(':fieldName', $fieldName);
    $stmt->bindValue(':leaderboard_id', $leaderboard_id);

    return $stmt->execute();
}

function getLeaderboardEntries($leaderboard_id) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbsubmissions WHERE boardID= :leaderboard_id');

    $stmt->bindValue(':leaderboard_id', $leaderboard_id);

    $stmt->execute();

    return $stmt->fetchAll();
}

function getLeaderboardEntry($leaderboard_id, $user_id) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbsubmissions WHERE boardID= :leaderboard_id AND userID= :user_id');

    $stmt->bindValue(':leaderboard_id', $leaderboard_id);
    $stmt->bindValue(':user_id', $user_id);

    $stmt->execute();

    return $stmt->fetch();
}

function getTopEntry($leaderboard_id) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbsubmissions WHERE boardID= :leaderboard_id ORDER BY score DESC LIMIT 1');

    $stmt->bindValue(':leaderboard_id', $leaderboard_id);

    $stmt->execute();

    return $stmt->fetch();
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