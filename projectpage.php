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

    $header = getTitle($token, $obj);
    $body = getPage($token, $obj);

}

function redexit() {
    header("Location: projects.html");
    exit();
}

function getPage($token, $xmlobj) {
    return "Body text";
}

function validate($token, $xmlobj) {
    return true;
}

function getTitle($token, $xmlobj) {
    return "Header text";
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
