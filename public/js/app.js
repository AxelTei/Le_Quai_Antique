// Buttons Go-to-the-Top Functions
let myButton = document.getElementById("myBtn");

window.onscroll = function() {scrollFunction()};

function scrollFunction()
{
    if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        myButton.style.display = "block";
    } else {
        myButton.style.display = "none";
    }
}

function topFunction() 
{
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
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Uncheck a radio button

let radio = document.getElementById("book_hourSelectedDay_7");

radio.addEventListener("click", function()
{
  if (radio.checked == true)
  {
    radio.checked = false;
  }
})

let radio2 = document.getElementById("book_hourSelectedNight_7");

radio2.addEventListener("click", function()
{
  if (radio2.checked == true)
  {
    radio2.checked = false;
  }
})

// Calendar Booking

$(function($)
{
  $('.js-datepicker').datepicker({
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    nextText: "Suivant",
    prevText: "Précédant",
    minDate: 0,
    dateFormat: "yy-mm-dd",
    beforeShowDay: noWednesday,
  });

  function noWednesday(date)
  {
    if (date.getDay() === 3) /* Wednesday */
    {
      return [false, "fermé", "Fermé le Mercredi"]
    } else 
    {
      return [true, "", ""]
    }
  }

  //GETTER
  // var dayNames = $('.js-datepicker').datepicker('option', "dayNames");
  //SETTER
  // $('.js-datepicker').datepicker("option", "dayNames", ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"])
})
