<?php

init();

function init() {

    $token = htmlspecialchars($_GET["page"]);
    if (empty($token)) {
        redexit();
    }

    // $url = "proj.xml";
    // $xml = simplexml_load_file($url);
    // print_r($xml);

    // print getXSLT("proj.xml", "proj.xsl");

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




function getXSLT($xml, $xsl) {

    if (empty($xsl)) {
        $xsl = $xml;
    }

    $mdoc = new DOMDocument();
    $mdoc->load($xml);

    $sdoc = new DOMDocument();
    $sdoc->load($xsl);

    $proc = new XSLTProcessor();
    $proc->importStylesheet($sdoc);
   
    $res = $proc->transformToDoc($mdoc);

    return $res->saveXML();

}


?>
