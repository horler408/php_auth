<?php 
    // To show error reporting
    error_reporting(E_ALL);

    session_start();

    // To set default time zone
    date_default_timezone_set("Africa/Lagos");

    // Home page url
    $home_url = "http://localhost/rest_api/practice/auth/";

    // To get page given in url parameter
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;

    $per_page = 5;

    $from_record_num = ($per_page * $page) - $per_page;
?>