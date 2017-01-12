<?php

/* Interface functions */

function spawnLightbox($prefix, $maxscreens) {
    $xmlobj = fetchXMLObj("proj.xml");
    $screenshots = gatherScreenshots($xmlobj, $prefix, $maxscreens);

    if (empty($screenshots)) {
        print '
        <h3 class="subheader">Search matched no screenshots</h3>
        ';
    }

    createModal($screenshots);

    createTiles($screenshots);
        

}


/* Base print functions */

function genLauncher($imgsrc, $slidenum, $alt) {
    print '<img src="' . $imgsrc . '" onclick="openModal();currentSlide(' . $slidenum . ')" class="hover-shadow launcher" alt="' . $alt . '">';
}

function genModalButton($imgsrc, $slidenum, $alt) {
    print '
    <img class="reel cursor" src="' . $imgsrc . '" onclick="currentSlide(' . $slidenum . ')" alt="' . $alt . '">
    ';
}

function genModal($imgsrc, $title, $tag) {
    print '
    <div class="slides">
      <div class="numbertext">' . $title . '<br />' . $tag . '</div>
        <div class="slideimghelp"></div>
        <img src="' . $imgsrc . '" class="slideimg">
    </div>
    ';
}

function colOpen() {
    print '<div class="column">';
}

function colClose() {
    print '</div>';
}

function rowOpen() {
    print '<div class="row">';
}

function rowClose() {
    print '</div>';
}


/* Higher print functions */

function createModal($screenshots) {
    print '
<div id="myModal" class="modal">
  <div class="modal-content">';

    createModals($screenshots);
    
    print '

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>';
    
    
    createModalButtons($screenshots);
    
    print '
    
  </div>
   <span class="close cursor" onclick="closeModal()">&times;</span>
</div>
    ';
}

function createModals($screenshots) {
    foreach ($screenshots as $screenshot) {
        genModal($screenshot->src, '', $screenshot->tag);
    }
}

function createModalButtons($screenshots) {
    $rowmax = 4;
    rowOpen();
    foreach($screenshots as $screenshot) {
        genModalButton($screenshot->src, $screenshot->getNum(), $screenshot->alt);
        
        if ($screenshot->getNum() % $rowmax === 0) {
            rowClose();
            rowOpen();
        }
        
    }
    rowClose();
}

function createTiles($screenshots) {
    $last = "";
    $rowindex = 0;
    $maxrow = 5;

    foreach($screenshots as $screenshot) {
        if ($last != $screenshot->tag) {
            if ($last !== "") {
                rowClose();
                print "<br />";
            }

            print '<a href="project-page.php?page=' . $screenshot->urltag . '" class="silent">';
            print '<h4 class="subheader">' . $screenshot->tag . '</h4>';
            print '</a>';
            rowOpen();
            $last = $screenshot->tag;
            $rowindex = 0;
        }

        genLauncher($screenshot->src, $screenshot->getNum(), $screenshot->alt);

        $rowindex = $rowindex + 1;
        if ($rowindex % $maxrow === 0) {
            rowClose();
            rowOpen();
        }

    }

    rowClose();
}

/* Data functions */

function gatherScreenshots($xmlobj, $prefix, $maxscreens) {
    if (empty($xmlobj)) {
        //print "Empty xml object";
        die();
    }
    
    $screens = array();
    $index = 0;
    
    foreach ($xmlobj->proj as $proj) {
        foreach ($proj->screenshots->screenshot as $screenshot) {

            if (!empty($maxscreens) && $index >= ($maxscreens - 1)) {
                break;
            }

            if (!empty($prefix)) {
                if (!strcont($proj->title, $prefix) && !strcont($screenshot->alt, $prefix)) {
                    continue;
                }
            }

            $index = $index + 1;
            
            $obj = new Screenshot(
                $screenshot->src, $proj->title, $proj->urltag, $screenshot->alt
            );
            $obj->assignNumber($index);
            
            $screens[] = $obj;

        }
    }
    
    return $screens;
    
}




/* Backend Data functions */

function fetchXMLObj($fname) {
    return simplexml_load_file($fname);
}



/* Class Definitions */
class Screenshot {
    public $src = "images/missing.jpg";
    public $tag = "";
    public $urltag = "";
    public $alt = "";
    public $num = 0;
    
    function __construct($src, $tag, $urltag, $alt) {
        $this->src = $src;
        $this->tag = $tag;
        $this->urltag = $urltag;
        $this->alt = $alt;
    }
    
    public function assignNumber($number) {
        $this->num = $number;
    }
    
    public function getNum() {
        return $this->num;
    }
    
}


/* Helper Functions */

function strcont($haystack, $needle) {
    $haystack = strtolower($haystack);
    $needle = strtolower($needle);
    return (strpos($haystack, $needle) !== false);
}

?>
