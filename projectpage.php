<?php

init();

function init() {

    $token = htmlspecialchars($_GET["page"]);
    if (empty($token)) {
        redexit();
    }

    echo "Token: [" . $token . "]";

}

function redexit() {
    header("Location: projects.html");
    exit();
}

function getPage() {

}

function validate($token) {

}

function getTitle($token) {

}



?>
