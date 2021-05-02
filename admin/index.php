<?php
// core configuration
include_once "../config/core.php";
 
// To check if logged in as admin
include_once "./auth_checker.php";
 
// To set page title
$page_title="Admin Dashboard";
 
// To include header HTML
include 'layout_head.php';
 
    echo "<div class='col-md-12'>";
 
        $action = isset($_GET['action']) ? $_GET['action'] : "";
 
        // To notify the user he's already logged in
        if($action=='already_logged_in'){
            echo "<div class='alert alert-info'>";
                echo "<strong>You</strong> are already logged in.";
            echo "</div>";
        }
 
        else if($action=='logged_in_as_admin'){
            echo "<div class='alert alert-info'>";
                echo "<strong>You</strong> are logged in as admin.";
            echo "</div>";
        }
 
        echo "<div class='alert alert-info'>";
            echo "Contents of your admin section will be here.";
        echo "</div>";
 
    echo "</div>";
 
// To include footer HTML
include_once 'layout_foot.php';
?>