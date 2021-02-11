<?php
$items_per_page = 10;
$version = "alpha";


$server_type = "dev";
$submit_article_email = "nickwasused.social@protonmail.com";
$footer_email = "nickwasused.social@protonmail.com";

if ($server_type = "dev") {
    ini_set('log_errors', 1);
    $sanitizerstate = "sanitize_output";
} else {
    ini_set('display_errors', 0);
    $sanitizerstate = null;
}

?>