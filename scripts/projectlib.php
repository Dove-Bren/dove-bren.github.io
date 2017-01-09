<?php

//if( !defined( __DIR__ ) ) define( __DIR__, dirname(__FILE__) );

//echo __DIR__."/screenslib.php";
//require_once(__DIR__."/screenslib.php");
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

    echo "1";
    $pobj = getProj($token, $obj);
    echo "2";

    $header = getTitle($pobj);
    echo "3";
    print getPage($pobj);
    echo "4";

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
    echo "a1";
    //return $pobj->fulldesc;
    $ret = getXSLT($pobj, "proj-full.xsl");

    echo "a2";
    if ($pobj->screenshots !== false) {
        echo "-";
        $ret .= '
            <div class="screenshotpeek">' .
                spawnLightbox($pobj->title, 4) . '
            </div>
        ';
    }

    echo "a3";

    return $ret;
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

function foo($out) {
    var_dump($out);
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
    $proc->registerPHPFunctions();
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
