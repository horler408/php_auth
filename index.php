<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title="User Dashboard";
 
// include login checker
$require_login=true;
include_once "auth_checker.php";
 
// To include header HTML
include_once 'layout_head.php';
 
echo "<div class='col-md-12'>";
 
    $action = isset($_GET['action']) ? $_GET['action'] : "";
 
    // If login was successful
    if($action =='login_success'){
        echo "<div class='alert alert-info'>";
            echo "<strong>Hi " . $_SESSION['first_name'] . ", welcome back!</strong>";
        echo "</div>";
    }
    // if user is already logged in
    else if($action=='already_logged_in'){
        echo "<div class='alert alert-info'>";
            echo "<strong>You are already logged in.</strong>";
        echo "</div>";
    }
 
    // Content once logged in
    echo "<div class='alert alert-info'>";
        echo "Content when logged in will be here. For example, your premium products or services.";
    echo "</div>";
 
echo "</div>";
 
// To include footer HTML
include 'layout_foot.php';
?>