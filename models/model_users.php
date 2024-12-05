<?php

include (__DIR__ . '/db.php');

function login($username, $password) {
    global $db;

    $stmt = $db->prepare('SELECT id FROM lbusers WHERE username= :user AND password = :pass');

    $stmt->bindValue(':user', $username);
    $stmt->bindValue(':pass', sha1("Salty-Spitoon" . $password));

    $stmt->execute();

    return($stmt->rowCount() > 0);
}


function register($username, $password) {
    global $db;

    $stmt = $db->prepare('INSERT INTO lbusers (username, password, signdate) VALUES (:user, :pass, :signdate)');

    $stmt->bindValue(':user', $username);
    $stmt->bindValue(':pass', sha1("Salty-Spitoon" . $password));
    $stmt->bindValue(':signdate', date('Y-m-d'));

    return $stmt->execute();
}

function getUser($username) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbusers WHERE username= :user');

    $stmt->bindValue(':user', $username);

    $stmt->execute();

    return $stmt->fetch();
}

function getBoards($user_id) {
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbleaderboards WHERE ownerID= :user_id');

    $stmt->bindValue(':user_id', $user_id);

    $stmt->execute();

    return $stmt->fetchAll();
}

function searchUser($user_id){
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbusers WHERE id= :user_id');

    $stmt->bindValue(':user_id', $user_id);

    $stmt->execute();

    return $stmt->fetch();
}

function userExists($username){
    global $db;

    $stmt = $db->prepare('SELECT * FROM lbusers WHERE username= :user');

    $stmt->bindValue(':user', $username);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}