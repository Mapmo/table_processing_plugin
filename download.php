<?php
session_start();
if(isset($_GET['export_file_extension']) && isset($_GET['export_filename']) && isset($_GET['file_to_save'])){

    //TODO sanitize user input

    echo "<div><p>The download will begin automatically.</p></div>";
    include "includes/streamfile.php";
}