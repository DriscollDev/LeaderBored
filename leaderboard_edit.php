<?php
    session_start();
    include './includes/header.php';
    include 'models/model_users.php';
    include 'models/model_leaderboards.php';

    if(isset($_SESSION['isLoggedIn'])){
        $username = $_SESSION['username'];
        $user = getUser($username);
        $user_id = $user['id'];
        $error = "";

    }
    else{
        header('Location: login.php');
    }

    if(isset($_GET['action']) && $_GET['action'] == 'edit'){
        $leaderboard = getLeaderboard($_GET['leaderboard_id']);
        $name = $leaderboard['lbName'];
        $description = $leaderboard['description'];
        $fieldname = $leaderboard['sortFieldName'];
        $datatype = $leaderboard['sortFieldType'];
        $sortdirection = $leaderboard['sortFieldDirection'];
        $validationreq = $leaderboard['isValidationReq'];

    }
    else{
        $name = "";
        $description = "";
        $fieldname = "";
        $datatype = "";
        $sortdirection = "";
        $validationreq = "";
    }

    if(isset($_POST['create'])){
        $leaderboard_name = filter_input(INPUT_POST,'leaderboard_name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST,'description', FILTER_SANITIZE_STRING);
        $fieldname = filter_input(INPUT_POST,'fieldname', FILTER_SANITIZE_STRING);
        $data_type = filter_input(INPUT_POST,'datatype', FILTER_SANITIZE_STRING);   
        $sort_direction = filter_input(INPUT_POST,'sortdirection', FILTER_SANITIZE_STRING);
        $validationreq = filter_input(INPUT_POST,'validationreq', FILTER_SANITIZE_STRING);
        
        $leaderboard_id = createLeaderboard($leaderboard_name, $description, $data_type, $sort_direction, $user_id,$validationreq, $fieldname);
        
        header('Location: leaderboard_view.php?leaderboard_id='.$leaderboard_id);
    }
    if(isset($_POST['update'])){
        $leaderboard_name = filter_input(INPUT_POST,'leaderboard_name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST,'description', FILTER_SANITIZE_STRING);
        $fieldname = filter_input(INPUT_POST,'fieldname', FILTER_SANITIZE_STRING);
        $data_type = filter_input(INPUT_POST,'datatype', FILTER_SANITIZE_STRING);   
        $sort_direction = filter_input(INPUT_POST,'sortdirection', FILTER_SANITIZE_STRING);
        $validationreq = filter_input(INPUT_POST,'validationreq', FILTER_SANITIZE_STRING);
        $leaderboard_id = $_GET['leaderboard_id'];
        
        updateLeaderboard($leaderboard_id, $leaderboard_name, $description, $data_type, $sort_direction, $validationreq, $fieldname);
        
        header('Location: leaderboard_view.php?leaderboard_id='.$leaderboard_id);
    }
?>

<style>
    .switch {
    --false: #E81B1B;
    --true: #009068;
    
    }

    input[type=checkbox] {
    appearance: none;
    height: 2.2rem;
    width: 3.5rem;
    background-color: #000;
    position: relative;
    border-radius: .2em;
    cursor: pointer;
    transform: translate(0%,20%);
    }

    input[type=checkbox]::before {
    content: '';
    display: block;
    height: 2em;
    width: 2em;
    transform: translate(-50%, -50%);
    position: absolute;
    top: 50%;
    left: calc(1.9em/2 + .3em);
    background-color: var(--false);
    border-radius: .2em;
    transition: .3s ease;
    }

    input[type=checkbox]:checked::before {
    background-color: var(--true);
    left: calc(100% - (1.9em/2 + .3em));
    }
</style>

<div class="w3-container w3-theme-d2 w3-margin-top">
    <div class="w3-row w3-center w3-margin-top">
        <h2>Create a new Leaderboard</h2>
        <div class="w3-col s3"><p></p></div>
        <div class="w3-col s6 w3-white" style="min-height:50vh">
            <form method="post">
                <div class="w3-row-padding w3-margin-top">
                    <div class="w3-half">
                        <input class="w3-input w3-border" type="text" placeholder="Leaderboard Name" name="leaderboard_name" value="<?php echo $name ?>">
                    </div>
                    <div class="w3-half">
                        <h3 style="display: inline; padding:1em">Require Proof?</h3>
                        <label class="switch center">
                            <input type="hidden" name="validationreq" value=0>
                            <input name="validationreq" type="checkbox" <?php  $validationreq ? 'checked': '' ?> value=1>
                        </label>
                    </div>
                </div> 
                <div class="w3-row-padding w3-margin-top">
                    <div class="w3-third">
                        <input class="w3-input w3-border" type="text" placeholder="Sort Field Name" name="fieldname" value="<?php echo $fieldname ?>">
                    </div>
                    <div class="w3-third">
                        <select class="w3-select w3-border" name="datatype">
                        <option value="" disabled <?php if($datatype==""){echo 'selected';} ?>>Data Type</option>
                        <option value="Time" <?php if($datatype=="Time"){echo 'selected';} ?> >Time</option>
                        <option value="Int" <?php if($datatype=="Int"){echo 'selected';} ?>>Number</option>
                        </select>
                    </div>
                    <div class="w3-third">
                        <select class="w3-select w3-border" name="sortdirection">
                        <option value="" disabled <?php if($datatype==""){echo 'selected';} ?>>Sort Direction</option>
                        <option value="Asc" <?php if($datatype=="Asc"){echo 'selected';} ?>>Lowest at Top</option>
                        <option value="Dec" <?php if($datatype=="Desc"){echo 'selected';} ?>>Highest at Top</option>
                        </select>
                    </div>
                </div> 
                <div class="w3-container w3-margin-top">
                    <textarea class="w3-input w3-border" placeholder="Description" name="description" rows="10" cols="10" ><?php echo $description ?></textarea>
                    
                </div>
                <div>

                </div>
                <div class="w3-col s3"><p></p></div>
                <div class="w3-row-padding w3-margin">
                    <?php if(isset($_GET['action']) && $_GET['action'] == 'edit'):?>
                    <div class="w3-half">
                        <input type="submit" name="update" value="Update Leaderboard" class="w3-btn w3-theme-d2">
                    </div>
                    <div class="w3-half">
                        <input type="submit" name="delete" value="Delete Leaderboard" class="w3-btn w3-red">
                    </div>
                    <?php else: ?>
                    <div class="w3-container">
                        <input type="submit" name="create" value="Create Leaderboard" class="w3-btn w3-theme-d2">
                    <?php endif; ?>
                </div>
            </form>
        </div>
        

    </div>
</div>




<?php include './includes/footer.php'; ?>