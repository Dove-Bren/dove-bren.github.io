<?php

$header = "";
$body = "";

init();

function init() {

    global $header, $body;

    $token = htmlspecialchars($_GET["page"]);
    if (empty($token)) {
        redexit();
    }

    // $url = "proj.xml";
    // $xml = simplexml_load_file($url);
    // print_r($xml);

    // print getXSLT("proj.xml", "proj.xsl");

    $obj = fetchXMLObj("proj.xml");
    if (empty($obj)) {
        redexit();
    }

    if (!validate($token, $obj)) {
        redexit();
    }

    $pobj = getProj($token, $obj);

    $header = getTitle($token, $pobj);
    $body = getPage($token, $pobj);

}

function redexit() {
    //header("Location: projects.html");
    //exit();
    die();
}

function getPage($token, $pobj) {
    return "Body text";
}

function validate($token, $xmlobj) {
    return getProj($token, $xmlobj) !== false;
}

function getProj($token, $xmlobj) {
    if (empty($token) or empty($xmlobj)) {
        return false;
    }

    foreach ($xmlobj->proj as $proj) {
        if (strcmp($proj->urltag, $token) === 0) {
            return $proj;
        }
    }

    return false;
    
}

function getTitle($token, $pobj) {
    return $pobj->title;
}


function fetchXMLObj($fname) {
    return simplexml_load_file($fname);
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
