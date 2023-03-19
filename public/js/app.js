// Buttons Go-to-the-Top Functions
let myButton = document.getElementById("myBtn");

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    myButton.style.display = "block";
  } else {
    myButton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

myButton.addEventListener("click", topFunction);

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("bookingBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function () {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Uncheck a radio button

let radio = document.getElementById("book_hourSelectedDay_7");

radio.addEventListener("click", function () {
  if (radio.checked == true) {
    radio.checked = false;
  }
})

let radio2 = document.getElementById("book_hourSelectedNight_7");

radio2.addEventListener("click", function () {
  if (radio2.checked == true) {
    radio2.checked = false;
  }
})

// Image Show Text and Title

let hoverImages = document.getElementsByClassName("card-img-top");
let hoverTitles = document.getElementsByClassName("card-title");
let hoverTexts = document.getElementsByClassName("card-text");

for (var i = 0; i < hoverImages.length; i++) {
  hoverImages[i].addEventListener("mouseover", showTitle(i));
  hoverImages[i].addEventListener("mouseout", disableTitle(i));
}

function showTitle(i) {
  return function () {
    hoverTitles[i].classList.add('hoverTitleAndText');
    hoverTexts[i].classList.add('hoverTitleAndText');

  }
}

function disableTitle(i) {
  return function () {
    hoverTitles[i].classList.remove('hoverTitleAndText');
    hoverTexts[i].classList.remove('hoverTitleAndText');
  }
}

// Calendar Booking

$(function ($) {
  $('.js-datepicker').datepicker({
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    nextText: "Suivant",
    prevText: "Précédant",
    minDate: 0,
    dateFormat: "yy-mm-dd",
    beforeShowDay: unavailable,
  });

  // if select day du .datepicker egale une des date dans l'array Day or Night display gris button et display a sentence

  //Limit Booking

  var datesForbiddensFromController = $('.end-booking').attr("name"); // data from Controller
  var datesForbiddens = datesForbiddensFromController.split(","); // find a way to concatenate php entry string in a array

  var runDaysForbiddensFromController = $('.end-booking-day').attr("name");
  var runNightsForbiddensFromController = $('.end-booking-night').attr("name");

  console.log(runDaysForbiddensFromController);
  console.log(runNightsForbiddensFromController);

  $closureDate = 3; // Set closure Day by Admin

  function unavailable(date){
    if (date.getDay() === $closureDate) /* Wednesday */ 
    {
      return [false, "fermé", "Fermé le Mercredi"]
    }
    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
    return [ datesForbiddens.indexOf(string) == -1 ]
  }
})
