<?php
    session_start();
    include './includes/header.php';
    include 'models/model_leaderboards.php';
    

?>

<div class="w3-row-padding w3-margin-top">
    <?php
    $leaderboards = getAllLeaderboards();

    if (!empty($leaderboards)):
        foreach ($leaderboards as $leaderboard):?> 
            <div class="w3-col s12 m6 l4">
                <div class="w3-card-4 w3-panel w3-theme-l3">
                    <h3><?php echo htmlspecialchars($leaderboard['lbName'])?></h3>
                    <div class="w3-container">
                    <p><?php echo htmlspecialchars($leaderboard['description'])?></p>
                    </div>
                <a class="w3-button w3-block w3-dark-grey w3-margin-bottom" href='leaderboard_view.php?leaderboard_id=<?php echo $leaderboard["id"]?>'> View </a>
                </div>
            </div>
        <?php endforeach; endif?>
</div>

    <?php include './includes/footer.php'; ?>