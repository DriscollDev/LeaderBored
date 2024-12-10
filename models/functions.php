<?php
    include ("model_users.php");
    include ("model_leaderboards.php");
    include ("model_submissions.php");

    function timeComp($a, $b) {
        return strtotime($a['score']) - strtotime($b['score']);
    }
    function intComp($a, $b) {
        return (int)$a['score'] - (int)$b['score'];
    }

    function getSubmissionPlacement($submission_id){
        $submission = getSubmission($submission_id);
        $board = getLeaderboard($submission['boardID']);
        $boardLeaders = getLeaderboardLeaders($board["id"],false);
        if($board["sortFieldType"] == "Int"){
            usort($boardLeaders, 'intComp');
        }
        else{
            usort($boardLeaders, 'timeComp');
        }
        if($board["sortFieldDirection"] == "Desc"){
            $boardLeaders = array_reverse($boardLeaders);
        }
        $placement = 1;
        foreach($boardLeaders as $leader){
            if($leader['id'] == $submission_id){
                return $placement;
            }
            $placement++;
        }
    }
    