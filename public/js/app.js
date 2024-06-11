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
let modal = document.getElementById("myModal");

// Get the button that opens the modal
let btn = document.getElementById("bookingBtn");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

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

// Utilisé par notre ancien Formulaire

// // Uncheck a radio button

// // let radio = document.getElementById("book_hourSelectedDay_7");

// // radio.addEventListener("click", function () {
// //   if (radio.checked == true) {
// //     radio.checked = false;
// //   }
// // })

// // let radio2 = document.getElementById("book_hourSelectedNight_7");

// // radio2.addEventListener("click", function () {
// //   if (radio2.checked == true) {
// //     radio2.checked = false;
// //   }
// // })

// Image Show Text and Title

let hoverImages = document.getElementsByClassName("card-img-top");
let hoverTitles = document.getElementsByClassName("card-title");
let hoverTexts = document.getElementsByClassName("card-text");

for (let i = 0; i < hoverImages.length; i++) {
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
    onSelect: disabledDayOrNight,
  });

  //Limit Booking

  let datesForbiddensFromController = $('.end-booking').attr("name"); // data from Controller
  let datesForbiddens = datesForbiddensFromController.split(","); // find a way to concatenate php entry string in a array

  let runDaysForbiddensFromController = $('.end-booking-day').attr("name");
  let runDaysForbiddens = runDaysForbiddensFromController.split(",");
  let runNightsForbiddensFromController = $('.end-booking-night').attr("name");
  let runNightsForbiddens = runNightsForbiddensFromController.split(",");

  let closureDate = 3; // Set closure Day by Admin

  if ($(".rule-booking-day").attr("name") === "lundi")
  {
    closureDate = 1;
  }
  if ($(".rule-booking-day").attr("name") === "mardi")
  {
    closureDate = 2;
  }
  if ($(".rule-booking-day").attr("name") === "mercredi")
  {
    closureDate = 3;
  }
  if ($(".rule-booking-day").attr("name") === "jeudi")
  {
    closureDate = 4;
  }
  if ($(".rule-booking-day").attr("name") === "vendredi")
  {
    closureDate = 5;
  }
  if ($(".rule-booking-day").attr("name") === "samedi")
  {
    closureDate = 6;
  }
  if ($(".rule-booking-day").attr("name") === "dimanche")
  {
    closureDate = 7;
  }

  function unavailable(date)
  {
    if (date.getDay() === closureDate) /* Wednesday */ 
    {
      return [false, "fermé", "Fermé le Mercredi"]
    }
    let string = jQuery.datepicker.formatDate('yy-mm-dd', date);
    return [ datesForbiddens.indexOf(string) == -1 ]
  }

  function disabledDayOrNight(date)
  {
    if (jQuery.inArray(date, runDaysForbiddens) > -1)
    {
      // Utilisé par notre ancien Formulaire

      // $('#book_hourSelectedDay_0').attr("disabled", true)
      // $('#book_hourSelectedDay_1').attr("disabled", true)
      // $('#book_hourSelectedDay_2').attr("disabled", true)
      // $('#book_hourSelectedDay_3').attr("disabled", true)
      // $('#book_hourSelectedDay_4').attr("disabled", true)
      // $('#book_hourSelectedDay_5').attr("disabled", true)
      // $('#book_hourSelectedDay_6').attr("disabled", true)

      // $('#book_hourSelectedNight_0').attr("disabled", false)
      // $('#book_hourSelectedNight_1').attr("disabled", false)
      // $('#book_hourSelectedNight_2').attr("disabled", false)
      // $('#book_hourSelectedNight_3').attr("disabled", false)
      // $('#book_hourSelectedNight_4').attr("disabled", false)
      // $('#book_hourSelectedNight_5').attr("disabled", false)
      // $('#book_hourSelectedNight_6').attr("disabled", false)
      $('#hourSelectedDay0').attr("disabled", true)
      $('#hourSelectedDay1').attr("disabled", true)
      $('#hourSelectedDay2').attr("disabled", true)
      $('#hourSelectedDay3').attr("disabled", true)
      $('#hourSelectedDay4').attr("disabled", true)
      $('#hourSelectedDay5').attr("disabled", true)
      $('#hourSelectedDay6').attr("disabled", true)
      $('#hourSelectedNight0').attr("disabled", false)
      $('#hourSelectedNight1').attr("disabled", false)
      $('#hourSelectedNight2').attr("disabled", false)
      $('#hourSelectedNight3').attr("disabled", false)
      $('#hourSelectedNight4').attr("disabled", false)
      $('#hourSelectedNight5').attr("disabled", false)
      $('#hourSelectedNight6').attr("disabled", false)

      $('.alert-end-booking-Day').css("display", "grid")
      $('.alert-end-booking-Night').css("display", "none")
    } else if (jQuery.inArray(date, runNightsForbiddens) > -1)
    {

      // Utilisé par notre ancien Formulaire

      // $('#book_hourSelectedNight_0').attr("disabled", true)
      // $('#book_hourSelectedNight_1').attr("disabled", true)
      // $('#book_hourSelectedNight_2').attr("disabled", true)
      // $('#book_hourSelectedNight_3').attr("disabled", true)
      // $('#book_hourSelectedNight_4').attr("disabled", true)
      // $('#book_hourSelectedNight_5').attr("disabled", true)
      // $('#book_hourSelectedNight_6').attr("disabled", true)

      // $('#book_hourSelectedDay_0').attr("disabled", false)
      // $('#book_hourSelectedDay_1').attr("disabled", false)
      // $('#book_hourSelectedDay_2').attr("disabled", false)
      // $('#book_hourSelectedDay_3').attr("disabled", false)
      // $('#book_hourSelectedDay_4').attr("disabled", false)
      // $('#book_hourSelectedDay_5').attr("disabled", false)
      // $('#book_hourSelectedDay_6').attr("disabled", false)
      $('#hourSelectedDay0').attr("disabled", false)
      $('#hourSelectedDay1').attr("disabled", false)
      $('#hourSelectedDay2').attr("disabled", false)
      $('#hourSelectedDay3').attr("disabled", false)
      $('#hourSelectedDay4').attr("disabled", false)
      $('#hourSelectedDay5').attr("disabled", false)
      $('#hourSelectedDay6').attr("disabled", false)
      $('#hourSelectedNight0').attr("disabled", true)
      $('#hourSelectedNight1').attr("disabled", true)
      $('#hourSelectedNight2').attr("disabled", true)
      $('#hourSelectedNight3').attr("disabled", true)
      $('#hourSelectedNight4').attr("disabled", true)
      $('#hourSelectedNight5').attr("disabled", true)
      $('#hourSelectedNight6').attr("disabled", true)

      $('.alert-end-booking-Night').css("display", "grid")
      $('.alert-end-booking-Day').css("display", "none")
    } else {

      // Utilisé par notre ancien Formulaire
      
      // $('#book_hourSelectedDay_0').attr("disabled", false)
      // $('#book_hourSelectedDay_1').attr("disabled", false)
      // $('#book_hourSelectedDay_2').attr("disabled", false)
      // $('#book_hourSelectedDay_3').attr("disabled", false)
      // $('#book_hourSelectedDay_4').attr("disabled", false)
      // $('#book_hourSelectedDay_5').attr("disabled", false)
      // $('#book_hourSelectedDay_6').attr("disabled", false)
      // $('#book_hourSelectedNight_0').attr("disabled", false)
      // $('#book_hourSelectedNight_1').attr("disabled", false)
      // $('#book_hourSelectedNight_2').attr("disabled", false)
      // $('#book_hourSelectedNight_3').attr("disabled", false)
      // $('#book_hourSelectedNight_4').attr("disabled", false)
      // $('#book_hourSelectedNight_5').attr("disabled", false)
      // $('#book_hourSelectedNight_6').attr("disabled", false)
      $('#hourSelectedDay0').attr("disabled", false)
      $('#hourSelectedDay1').attr("disabled", false)
      $('#hourSelectedDay2').attr("disabled", false)
      $('#hourSelectedDay3').attr("disabled", false)
      $('#hourSelectedDay4').attr("disabled", false)
      $('#hourSelectedDay5').attr("disabled", false)
      $('#hourSelectedDay6').attr("disabled", false)
      $('#hourSelectedNight0').attr("disabled", false)
      $('#hourSelectedNight1').attr("disabled", false)
      $('#hourSelectedNight2').attr("disabled", false)
      $('#hourSelectedNight3').attr("disabled", false)
      $('#hourSelectedNight4').attr("disabled", false)
      $('#hourSelectedNight5').attr("disabled", false)
      $('#hourSelectedNight6').attr("disabled", false)

      $('.alert-end-booking-Day').css("display", "none")
      $('.alert-end-booking-Night').css("display", "none")
    }
  }
})

// Nouvelles fonctionnalités de RESERVATION

const formBooking = document.getElementById("formBooking");
const btnBooking = document.getElementById("btnBooking");

btnBooking.addEventListener("click", book);

function book()
{
  let dataForm = new FormData(formBooking);

  let date = dataForm.get("date");
  let serviceM = dataForm.get("serviceMidi");
  let serviceS = dataForm.get("serviceSoir");
  let name = dataForm.get("alias");
  let phone = dataForm.get("phoneNumber");
  let preferedGroupNumber = dataForm.get("preferedGroupNumber");
  let allergies = dataForm.get("allergies");

  let myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");

  let raw = JSON.stringify({
    "alias": name,
    "date": date,
    "hourSelectedDay": serviceM,
    "hourSelectedNight": serviceS,
    "phoneNumber": phone,
    "preferedGroupNumber": parseInt(preferedGroupNumber),
    "allergies": allergies
  });

  let requestOptions = {
    method: 'POST',
    headers: myHeaders,
    body: raw,
    redirect: 'follow'
  };

  fetch("http://whispering-shore-76724-12dedaea775f.herokuapp.com/bookJS", requestOptions)
  .then(response => {
    if(response.ok)
      {
        alert("Votre réservation a bien été enregistré !")
      } else {
        alert("Erreur lors de votre réservation.")
      }
  })
  .then(result => {
    document.location.href="/";
  })
}

// Function pour échapper le retour client en JS, transforme le HTML en Texte
function sanitizeHtml(text)
{
  const tempHtml = document.createElement('div');
  tempHtml.textContent = text;
  return tempHtml.innerHTML;
}