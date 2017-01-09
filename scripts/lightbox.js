/**************
 *
 * This code adapted from the w3schools tutorial
 * http://www.w3schools.com/howto/howto_js_lightbox.asp
 *
 ***************/

document.onkeypress = function(evt) {
    evt = evt || window.event;

    //ESC
    if (evt.keyCode == 27) {
        closeModal();
    }

    //LEFT
    if (evt.keyCode == 37) {
        plusSlides(-1);
    }

    //RIGHT
    if (evt.keyCode == 39) {
        plusSlides(1);
    }

    //SPACE
    if (evt.keyCode == 32) {
        plusSlides(1);
    }

    //ENTER
    if (evt.keyCode == 13) {
        plusSlides(1);
    }

    //BACKSPACE
    if (evt.keyCode == 8) {
        plusSlides(-1);
    }

};
 
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slides");
  var dots = document.getElementsByClassName("reel");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}


