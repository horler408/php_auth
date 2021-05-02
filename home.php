<?php
    // To include core configuration
    include_once "./config/core.php";
    
    // To set page title
    $page_title = "Index";

    include_once "./navigation.php";

    include_once "./layout_head.php";
    echo "Hello World!";

    include_once "./layout_foot.php";
?>