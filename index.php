<?php
require_once './php/autoload.php';
$util = new Util();
$login = new Login();


// Find future way to determine where POST requests come from ie. Whether they are from the login form or from the
if ($util->isPostRequest() && $_SESSION['logged_in'] === false) {
    $email = filter_input(INPUT_POST, 'login-email');
    $password = filter_input(INPUT_POST, 'login-password');

    $login->getLogin($email, $password, $db);
}

?>
<!DOCTYPE html>
<html>
<meta content="utf-8" http-equiv="encoding"/>
<head>
    <title>schEDUle</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="dist/main.css" type="text/css"/>
</head>

<?php if ($_SESSION['logged_in'] === false) { ?>
<body onload="loadPage('login')">
<?php } else { ?>
<body onload="loadPage('home')">
<?php } ?>

<div id="header">
    <div id="header-image"> 
        <span><?php echo "Welcome " . " " . $_SESSION['account'][0]['user_name']; ?></span>
    </div>
    <span class="pull-right date"><?php date_default_timezone_set('America/New_York'); echo date("l, F d, Y");?></span>
</div>

<div class="content-wrapper">
    <div id="side-bar">
        <ul>
            <!--?php if ($_SESSION["user_name"] === "") { ?>
              <li onclick="loadPage('home')" class="nav-home"><span class="fa fa-home"></span>Home</li>
              <!--body onclick="loadPage('home')">Home</li-->
            <!--li onclick="loadPage('login')">Log In</li-->
            <!--?php } else { ?!-->
            <li onclick="loadPage('home')" class="nav-home"><span class="fa fa-home"></span>Home</li>
            <li onclick="loadPage('building')" class="nav-building"><span class="fa fa-building-o"></span>Building</li>
            <li onclick="loadPage('classroom')" class="nav-classroom"><span class="fa fa-desktop"></span>Classroom</li>
            <li onclick="loadPage('course')" class="nav-course"><span class="fa fa-book"></span>Course</li>
            <li onclick="loadPage('curriculum')" class="nav-curriculum"><span class="fa fa-map-signs"></span>Curriculum
            </li>
            <li onclick="loadPage('faculty')" class="nav-faculty"><span class="fa fa-id-badge"></span>Faculty</li>
            <li onclick="loadPage('schedule-wizard')" class="nav-schedule-wizard"><span class="fa fa-magic"></span>Schedule
                Wizard
            </li>
            <li onclick="loadPage('myschedule')" class="nav-myschedule"><span class="fa fa-user-circle-o"></span>My
                Schedule
            </li>
            <li onclick="loadPage('login')"><span class="fa fa-sign-out"></span>Log Out</li>
            <!--<li onclick="loadPage('login')">Log In</li>-->
            <!--?php } ?-->
        </ul>
    </div>

    <div id="container" class="content-container">

    </div>

</div>
<div class="modal-bg">
</div>

<div class="modal-container demo-modal">
    <div class="modal-header">
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
        <button class="pull-right" onclick="closeModal('.demo-modal')">Close</button>
    </div>
</div>

<div class="modal-container schedule-modal">
    <div class="modal-header">
    </div>
    <div class="modal-body">
        <div class="alert-box info">
            <div class="alert-icon">
                <span class="fa fa-info-circle"></span>
            </div>
            <div class="alert-text">
                Schedule Uploaded Successfully
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn btn-success pull-right" onclick="closeModal('.schedule-modal')">Schedule</button>
        <button class="btn btn-default pull-right" onclick="closeModal('.schedule-modal')">Cancel</button>
    </div>
</div>


<script src="dist/main.js" type="text/javascript"></script>

</body>
</html>
