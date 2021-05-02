<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "auth_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../objects/user.php';
 
// To get database connection
$database = new Database();
$db = $database->getConnection();
 
// To initialize objects
$user = new User($db);
 
// To set page title
$page_title = "Users";
 
// To include header HTML
include_once "layout_head.php";
 
echo "<div class='col-md-12'>";
 
    // read all users from the database
    $stmt = $user->readAll($from_record_num, $per_page);
 
    // count retrieved users
    $num = $stmt->rowCount();
 
    // To identify page for paging
    $page_url="read_users.php?";
 
    // To include products table HTML template
    include_once "read_users_template.php";
 
echo "</div>";
 
// To include footer HTML
include_once "layout_foot.php";
?>