<?php

$header = "";

function displayProjectPage() {

    global $header;

    $token = htmlspecialchars($_GET["page"]);
    if (empty($token)) {
        redexit();
    }

    $obj = fetchXMLObj("proj.xml");
    if (empty($obj)) {
        redexit();
    }

    if (!validate($token, $obj)) {
        redexit();
    }


    //echo $obj->asXML();
    //print "<br /><br /><hr />";


    $pobj = getProj($token, $obj);

    $header = getTitle($pobj);
    print getPage($pobj);

}

function displayProjects($key) {
    //key is search key, if there is one
    
    $obj = fetchXMLObj("proj.xml");
    if (empty($obj)) {
        print "Unable to load project data";
        die();
    }

    $pobj = filterProj($key, $obj);
    print getXSLT($pobj, "proj-long.xsl");

}

function redexit() {
    header("Location: projects.php");
    exit();
    /*
    echo "reach'ed die";
    die();
    */
}

function filterProj($key, $obj) {
    if (empty($key)) {
        return $obj;
    }

    $pobj = '<?xml version="1.0"?><?xml-stylesheet type="text/xsl" href="proj.xsl"?><projects>';
    
    foreach ($obj->proj as $proj) {
        if (!strcont($proj->title, $key)
            && !strcont($proj->longdesc, $key)) {

            $trip = false;

            foreach ($proj->tags->tag as $tag) {
                if (strcont($tag, $key)) {
                    $trip = true;
                    break;
                }
            }
            if (!$trip) {
                continue;
            }
        }

        $pobj .= $proj->asXML();

        //$pobj->addChild($proj);
    }

    $pobj .= "</projects>";

    $pobj = new SimpleXMLElement($pobj);

    return $pobj;

}

function getPage($pobj) {
    //return $pobj->fulldesc;
    return getXSLT($pobj, "proj-full.xsl");
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

function getTitle($pobj) {
    return $pobj->title;
}


function fetchXMLObj($fname) {
    return simplexml_load_file($fname);
}

function getXSLT($xml, $xsl) {

    /*
    if (empty($xsl)) {
        $xsl = $xml;
    }
    */

    $xml = new SimpleXMLElement($xml->asXML());

    //var_dump($xml);
    //echo "<br /><hr />";

    //$mdoc = new DOMDocument();
    //$mdoc->loadXML($xml->asXML());
    //$mdoc = dom_import_simplexml($xml);

    $sdoc = new DOMDocument();
    $sdoc->load($xsl);

    $proc = new XSLTProcessor();
    $proc->importStylesheet($sdoc);
   
    $res = $proc->transformToXML($xml);

    /*

    $mdoc = new DOMDocument();
    $mdoc->loadXML($res);
    
    */

    return $res;

    //return $res;

}

function strcont($haystack, $needle) {
    $haystack = strtolower($haystack);
    $needle = strtolower($needle);

    return (strpos($haystack, $needle) !== false);
}

?>
