<?php

/* Interface functions */

function spawnLightbox() {
    $xmlobj = fetchXMLObj("proj.xml");
    $screenshots = gatherScreenshots($xmlobj);

    createModal($screenshots);
    
    genLauncher("images/questmanager_1.png", 1, "no alt");

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
  <span class="close cursor" onclick="closeModal()">&times;</span>
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
</div>
    ';
}

function createModals($screenshots) {
    foreach ($screenshots as $screenshot) {
        genModal($screenshot->src, '', $screenshot->tag);
    }
}

function createModalButtons($screenshots) {
    $rowmax = 6;
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



/* Data functions */

function gatherScreenshots($xmlobj) {
    if (empty($xmlobj)) {
        print "Empty xml object";
        die();
    }
    
    $screens = array();
    $index = 1;
    
    foreach ($xmlobj->proj as $proj) {
        foreach ($proj->screenshots->screenshot as $screenshot) {
            $obj = new Screenshot(
                $screenshot->src, $proj->title, $screenshot->alt
            );
            $obj->assignNumber($index);
            $index = $index + 1;
            
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
    public $alt = "";
    public $num = 0;
    
    function __construct($src, $tag, $alt) {
        $this->src = $src;
        $this->tag = $tag;
        $this->alt = $alt;
    }
    
    public function assignNumber($number) {
        $this->num = $number;
    }
    
    public function getNum() {
        return $this->num;
    }
    
}



/*
 <div class="row">
  <div class="column">
    <img src="img1.jpg" onclick="openModal();currentSlide(1)" class="hover-shadow">
  </div>
  <div class="column">
    <img src="img2.jpg" onclick="openModal();currentSlide(2)" class="hover-shadow">
  </div>
  <div class="column">
    <img src="img3.jpg" onclick="openModal();currentSlide(3)" class="hover-shadow">
  </div>
  <div class="column">
    <img src="img4.jpg" onclick="openModal();currentSlide(4)" class="hover-shadow">
  </div>
</div>

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="slides">
      <div class="numbertext">1 / 4</div>
        <img src="img_nature_wide.jpg" style="width:100%">
    </div>

    <div class="slides">
      <div class="numbertext">2 / 4</div>
        <img src="img_fjords_wide.jpg" style="width:100%">
    </div>

    <div class="slides">
      <div class="numbertext">3 / 4</div>
        <img src="img_mountains_wide.jpg" style="width:100%">
    </div>

    <div class="slides">
      <div class="numbertext">4 / 4</div>
        <img src="img_lights_wide.jpg" style="width:100%">
    </div>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <div class="column">
      <img class="reel" src="img1.jpg" onclick="currentSlide(1)" alt="Nature">
    </div>

    <div class="column">
      <img class="reel" src="img2.jpg" onclick="currentSlide(2)" alt="Trolltunga">
    </div>

    <div class="column">
      <img class="reel" src="img3.jpg" onclick="currentSlide(3)" alt="Mountains">
    </div>

    <div class="column">
      <img class="reel" src="img4.jpg" onclick="currentSlide(4)" alt="Lights">
    </div>
  </div>
</div>
*/

?>
